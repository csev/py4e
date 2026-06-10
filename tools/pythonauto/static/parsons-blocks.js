/**
 * Parsons block builder for pythonauto.
 *
 * Splits solution code into small line-based blocks, then callers shuffle
 * for display. Seeded for deterministic output per student.
 */
(function (root, factory) {
    'use strict';
    if (typeof module === 'object' && module.exports) {
        module.exports = factory();
    } else {
        root.ParsonsBlocks = factory();
    }
}(typeof self !== 'undefined' ? self : this, function () {

    var SHORT_PROGRAM_LINES = 6;
    var MIN_BLOCK_LINES = 1;
    var MAX_BLOCK_LINES = 3;

    function makeRng(seed) {
        return function () {
            seed = (seed + 0x6d2b79f5) | 0;
            var t = Math.imul(seed ^ (seed >>> 15), 1 | seed);
            t = (t + Math.imul(t ^ (t >>> 7), 61 | t)) ^ t;
            return ((t ^ (t >>> 14)) >>> 0) / 4294967296;
        };
    }

    function shuffle(arr, rng) {
        var a = arr.slice();
        for (var i = a.length - 1; i > 0; i--) {
            var j = Math.floor(rng() * (i + 1));
            var tmp = a[i];
            a[i] = a[j];
            a[j] = tmp;
        }
        return a;
    }

    function clamp(n, lo, hi) {
        return Math.max(lo, Math.min(hi, n));
    }

    function normalSample(rng) {
        var u = 0;
        var v = 0;
        while (u === 0) {
            u = rng();
        }
        while (v === 0) {
            v = rng();
        }
        return Math.sqrt(-2.0 * Math.log(u)) * Math.cos(2.0 * Math.PI * v);
    }

    function isIndented(line) {
        return line.length > 0 && (line.charAt(0) === ' ' || line.charAt(0) === '\t');
    }

    function getCodeLines(code) {
        return code.replace(/\r/g, '').split('\n').filter(function (line) {
            var trimmed = line.trim();
            return trimmed.length > 0 && trimmed.charAt(0) !== '#';
        });
    }

    function sumArray(arr) {
        var total = 0;
        for (var i = 0; i < arr.length; i++) {
            total += arr[i];
        }
        return total;
    }

    /**
     * Target block sizes in [minSize, maxSize] that sum to lineCount.
     * Uses a normal-ish draw around the mean, then adjusts to fit exactly.
     */
    function computeBlockSizes(lineCount, numBlocks, rng, minSize, maxSize) {
        minSize = minSize || MIN_BLOCK_LINES;
        maxSize = maxSize || MAX_BLOCK_LINES;

        if (numBlocks <= 0) {
            return [];
        }
        if (numBlocks === lineCount) {
            var ones = [];
            for (var i = 0; i < lineCount; i++) {
                ones.push(1);
            }
            return ones;
        }

        var mean = lineCount / numBlocks;
        var sizes = [];
        var i;
        for (i = 0; i < numBlocks; i++) {
            var draw = Math.round(mean + normalSample(rng) * 0.85);
            sizes.push(clamp(draw, minSize, maxSize));
        }

        sizes = adjustSizesToSum(sizes, lineCount, minSize, maxSize, rng);
        return sizes;
    }

    function adjustSizesToSum(sizes, target, minSize, maxSize, rng) {
        var sizesCopy = sizes.slice();
        var guard = 0;

        while (sumArray(sizesCopy) < target && guard < 10000) {
            var growIdx = Math.floor(rng() * sizesCopy.length);
            if (sizesCopy[growIdx] < maxSize) {
                sizesCopy[growIdx]++;
            }
            guard++;
        }

        guard = 0;
        while (sumArray(sizesCopy) > target && guard < 10000) {
            var shrinkIdx = Math.floor(rng() * sizesCopy.length);
            if (sizesCopy[shrinkIdx] > minSize) {
                sizesCopy[shrinkIdx]--;
            }
            guard++;
        }

        if (sumArray(sizesCopy) !== target) {
            return fallbackBlockSizes(target, sizesCopy.length, minSize, maxSize, rng);
        }
        return sizesCopy;
    }

    function fallbackBlockSizes(lineCount, numBlocks, minSize, maxSize, rng) {
        var sizes = [];
        var i;
        for (i = 0; i < numBlocks; i++) {
            sizes.push(minSize);
        }
        var remaining = lineCount - sumArray(sizes);
        var order = shuffle(range(numBlocks), rng);
        var idx = 0;
        var guard = 0;
        while (remaining > 0 && guard < 10000) {
            var pos = order[idx % numBlocks];
            if (sizes[pos] < maxSize) {
                sizes[pos]++;
                remaining--;
            }
            idx++;
            guard++;
        }
        return sizes;
    }

    function range(n) {
        var arr = [];
        for (var i = 0; i < n; i++) {
            arr.push(i);
        }
        return arr;
    }

    function partitionLines(lines, sizes) {
        var blocks = [];
        var offset = 0;
        for (var i = 0; i < sizes.length; i++) {
            var size = sizes[i];
            var slice = lines.slice(offset, offset + size);
            offset += size;
            if (slice.length) {
                blocks.push(slice.join('\n'));
            }
        }
        return blocks;
    }

    /**
     * How many blocks to aim for: short programs get one line each; longer
     * programs get more (smaller) blocks, capped by maxBlockLines per block.
     */
    function computeTargetBlockCount(lineCount, maxBlockLines) {
        if (lineCount <= SHORT_PROGRAM_LINES) {
            return lineCount;
        }
        return Math.min(lineCount, Math.ceil(lineCount / maxBlockLines));
    }

    /**
     * Build ordered Parsons blocks (not shuffled) from complete solution code.
     */
    function makeParsonsBlocks(code, seed, options) {
        options = options || {};
        var maxBlockLines = options.maxBlockLines || MAX_BLOCK_LINES;

        var lines = getCodeLines(code);
        if (!lines.length) {
            return [];
        }

        var lineCount = lines.length;
        var numBlocks = options.maxBlocks || computeTargetBlockCount(lineCount, maxBlockLines);
        numBlocks = Math.min(lineCount, Math.max(1, numBlocks));
        var rng = makeRng(seed >>> 0);
        var sizes = computeBlockSizes(lineCount, numBlocks, rng, MIN_BLOCK_LINES, maxBlockLines);
        return partitionLines(lines, sizes);
    }

    function shuffleBlocks(blocks, seed) {
        if (!blocks.length) {
            return [];
        }
        return shuffle(blocks, makeRng((seed + 0x9e3779b9) >>> 0));
    }

    function makeScrambledParsonsBlocks(code, seed, options) {
        var ordered = makeParsonsBlocks(code, seed, options);
        return shuffleBlocks(ordered, seed);
    }

    return {
        SHORT_PROGRAM_LINES: SHORT_PROGRAM_LINES,
        MIN_BLOCK_LINES: MIN_BLOCK_LINES,
        MAX_BLOCK_LINES: MAX_BLOCK_LINES,
        makeRng: makeRng,
        shuffle: shuffle,
        isIndented: isIndented,
        getCodeLines: getCodeLines,
        computeBlockSizes: computeBlockSizes,
        computeTargetBlockCount: computeTargetBlockCount,
        partitionLines: partitionLines,
        makeParsonsBlocks: makeParsonsBlocks,
        shuffleBlocks: shuffleBlocks,
        makeScrambledParsonsBlocks: makeScrambledParsonsBlocks
    };
}));
