/* Parsons modal UI — drag-and-drop reorder, no copy */
(function () {
    'use strict';

    function escapeHtml(text) {
        return text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }

    function renderBlock(text, index) {
        var lines = escapeHtml(text).split('\n');
        var html = '';
        for (var i = 0; i < lines.length; i++) {
            if (i > 0) {
                html += '<br>';
            }
            html += lines[i];
        }
        return '<div class="parsons-block">' +
            '<span class="parsons-block-num">' + (index + 1) + '</span>' +
            '<span class="parsons-drag-grip" aria-hidden="true">&#8942;</span>' +
            '<div class="parsons-block-code">' + html + '</div>' +
            '</div>';
    }

    function renumberParsonsBlocks() {
        $('#parsons-blocks .parsons-block').each(function (i) {
            $(this).find('.parsons-block-num').text(i + 1);
        });
    }

    function destroyParsonsSortable() {
        var $container = $('#parsons-blocks');
        if ($container.hasClass('ui-sortable')) {
            $container.sortable('destroy');
        }
    }

    function initParsonsSortable() {
        destroyParsonsSortable();
        $('#parsons-blocks').sortable({
            axis: 'y',
            cursor: 'move',
            tolerance: 'pointer',
            placeholder: 'parsons-block parsons-block-placeholder',
            forcePlaceholderSize: true,
            update: renumberParsonsBlocks
        });
    }

    window.showParsonsHint = function () {
        if (!window.ParsonsBlocks || !window.PARSONS_XCODE || window.PARSONS_SEED === false) {
            return false;
        }
        var scrambled = window.ParsonsBlocks.makeScrambledParsonsBlocks(
            window.PARSONS_XCODE,
            window.PARSONS_SEED
        );
        if (!scrambled.length) {
            alert('No example fragments are available for this exercise.');
            return false;
        }
        var html = '';
        for (var i = 0; i < scrambled.length; i++) {
            html += renderBlock(scrambled[i], i);
        }
        destroyParsonsSortable();
        document.getElementById('parsons-blocks').innerHTML = html;
        initParsonsSortable();
        $('#parsons-hint').modal();
        return false;
    };

    function resetParsonsModalPosition() {
        var $dialog = $('#parsons-hint .modal-dialog');
        $dialog.css({ top: '', left: '', margin: '' });
        $dialog.removeData('parsons-drag-ready');
    }

    function initParsonsModalDraggable() {
        var $modal = $('#parsons-hint');
        if (!$modal.length) {
            return;
        }
        $modal.on('shown.bs.modal', function () {
            var $dialog = $modal.find('.modal-dialog');
            if (!$dialog.data('ui-draggable')) {
                $dialog.draggable({
                    handle: '.modal-header',
                    containment: 'window',
                    scroll: false,
                    start: function () {
                        if (!$(this).data('parsons-drag-ready')) {
                            $(this).css('margin', 0);
                            $(this).data('parsons-drag-ready', true);
                        }
                    }
                });
            }
        });
        $modal.on('hidden.bs.modal', resetParsonsModalPosition);
    }

    window.initParsonsHintGuards = function () {
        var modal = document.getElementById('parsons-hint');
        if (!modal) {
            return;
        }
        function blockCopy(e) {
            e.preventDefault();
        }
        modal.addEventListener('copy', blockCopy);
        modal.addEventListener('cut', blockCopy);
        modal.addEventListener('contextmenu', blockCopy);
        modal.addEventListener('selectstart', blockCopy);
        initParsonsModalDraggable();
    };
}());
