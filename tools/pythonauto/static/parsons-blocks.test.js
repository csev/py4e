#!/usr/bin/env node
'use strict';

var ParsonsBlocks = require('./parsons-blocks.js');
var assert = require('assert');

var passed = 0;
var failed = 0;

function test(name, fn) {
    try {
        fn();
        passed++;
        console.log('ok - ' + name);
    } catch (err) {
        failed++;
        console.error('FAIL - ' + name);
        console.error(err.message);
    }
}

function linesOf(blocks) {
    return blocks.join('\n').split('\n');
}

test('empty code returns no blocks', function () {
    assert.deepStrictEqual(ParsonsBlocks.makeParsonsBlocks('', 42), []);
    assert.deepStrictEqual(ParsonsBlocks.makeParsonsBlocks('   \n# comment\n', 42), []);
});

test('six lines become six single-line blocks', function () {
    var code = 'a\nb\nc\nd\ne\nf';
    var blocks = ParsonsBlocks.makeParsonsBlocks(code, 99);
    assert.strictEqual(blocks.length, 6);
    blocks.forEach(function (block) {
        assert.strictEqual(block.split('\n').length, 1);
    });
    assert.deepStrictEqual(linesOf(blocks), ParsonsBlocks.getCodeLines(code));
});

test('twenty lines produce many small blocks with all content preserved', function () {
    var lines = [];
    for (var i = 1; i <= 20; i++) {
        lines.push('line' + i + ' = ' + i);
    }
    var code = lines.join('\n');
    var blocks = ParsonsBlocks.makeParsonsBlocks(code, 12345);
    assert.ok(blocks.length >= 7);
    assert.deepStrictEqual(linesOf(blocks), ParsonsBlocks.getCodeLines(code));
    blocks.forEach(function (block) {
        var count = block.split('\n').length;
        assert.ok(count >= ParsonsBlocks.MIN_BLOCK_LINES);
        assert.ok(count <= ParsonsBlocks.MAX_BLOCK_LINES);
    });
});

test('long programs use at most three lines per block', function () {
    var code = [
        'a = 1',
        'b = 2',
        'c = 3',
        'd = 4',
        'e = 5',
        'f = 6',
        'g = 7',
        'h = 8',
        'i = 9',
        'j = 10'
    ].join('\n');
    var blocks = ParsonsBlocks.makeParsonsBlocks(code, 7);
    assert.ok(blocks.length >= 4);
    blocks.forEach(function (block) {
        assert.ok(block.split('\n').length <= ParsonsBlocks.MAX_BLOCK_LINES);
    });
});

test('exercise 9.4 style program gets many blocks not a few large ones', function () {
    var code = [
        'name = input("Enter file:")',
        'if len(name) < 1 : name = "mbox-short.txt"',
        'handle = open(name)',
        'counts = dict()',
        'for line in handle:',
        '    wds = line.split()',
        '    if len(wds) < 2 : continue',
        '    if wds[0] != "From" : continue',
        '    email = wds[1]',
        '    counts[email] = counts.get(email,0) + 1',
        'bigcount = None',
        'bigname = None',
        'for name,count in counts.items():',
        '    if bigname is None or count > bigcount:',
        '        bigname = name',
        '        bigcount = count',
        'print(bigname, bigcount)'
    ].join('\n');
    var blocks = ParsonsBlocks.makeParsonsBlocks(code, 12345);
    assert.ok(blocks.length >= 6, 'expected many blocks, got ' + blocks.length);
    assert.deepStrictEqual(linesOf(blocks), ParsonsBlocks.getCodeLines(code));
});

test('same seed gives same blocks and scramble', function () {
    var code = 'x = 1\ny = 2\nz = 3\nprint(x)\nprint(y)\nprint(z)\nprint(x+y+z)';
    var a = ParsonsBlocks.makeScrambledParsonsBlocks(code, 999);
    var b = ParsonsBlocks.makeScrambledParsonsBlocks(code, 999);
    assert.deepStrictEqual(a, b);
});

test('different seeds can scramble differently', function () {
    var code = [];
    for (var i = 0; i < 12; i++) {
        code.push('step' + i + '()');
    }
    code = code.join('\n');
    var a = ParsonsBlocks.makeScrambledParsonsBlocks(code, 1);
    var b = ParsonsBlocks.makeScrambledParsonsBlocks(code, 2);
    assert.notDeepStrictEqual(a, b);
});

test('shuffle includes every block exactly once', function () {
    var code = 'import math\na = 1\nb = 2\nc = a + b\nprint(c)';
    var ordered = ParsonsBlocks.makeParsonsBlocks(code, 314);
    var scrambled = ParsonsBlocks.shuffleBlocks(ordered, 314);
    assert.strictEqual(scrambled.length, ordered.length);
    assert.deepStrictEqual(scrambled.slice().sort(), ordered.slice().sort());
});

console.log('\n' + passed + ' passed, ' + failed + ' failed');
process.exit(failed ? 1 : 0);
