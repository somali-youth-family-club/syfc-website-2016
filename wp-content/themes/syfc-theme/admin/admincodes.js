(function() {
    tinymce.create('tinymce.plugins.mboy', {
        init : function(ed, url) {
            ed.addButton('half', {
                title : 'Two Columns',
                image : url+'/half.png',
                onclick : function() {
                    var content = ed.selection.getContent();
                    if(content == "") content = 'First column content goes here';
                    ed.selection.setContent('[col-group] <br> [half]' + content + '[/half] <br> [half] Second column content goes here [/half] <br> [/col-group]');
                }
            });
            ed.addButton('third', {
                title : 'Three Columns',
                image : url+'/third.png',
                onclick : function() {
                    var content = ed.selection.getContent();
                    if(content == "") content = 'First column content goes here';
                    ed.selection.setContent('[col-group] <br> [third]' + content + '[/third] <br> [third] Second column content goes here [/third] <br> [third] Third column content goes here [/third] <br> [/col-group]');
                }
            });
            ed.addButton('two-thirds', {
                title : 'One third and two thirds columns',
                image : url+'/two-thirds.png',
                onclick : function() {
                    var content = ed.selection.getContent();
                    if(content == "") content = 'First column content goes here';
                    ed.selection.setContent('[col-group] <br> [third]' + content + '[/third] <br> [two-thirds] Second column content goes here [/two-thirds] <br> [/col-group]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mboy', tinymce.plugins.mboy);
})();