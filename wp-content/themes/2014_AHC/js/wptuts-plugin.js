(function() {
    tinymce.create('tinymce.plugins.WPTuts', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {
            ed.addCommand('youtube', function() {
				var youtubeID=prompt('Id de la video YouTube: ','');
				ed.selection.setContent('[youtube id='+youtubeID+']');		
            });
			
            ed.addCommand('vimeo', function() {
				var vimeoID=prompt('Id de la video Vimeo: ','');
				ed.selection.setContent('[vimeo id='+vimeoID+']');		
            });
            ed.addCommand('daily', function() {
				var dailyID=prompt('Id de la video DailyMotion: ','');
				ed.selection.setContent('[daily id='+dailyID+']');		
            });            
			ed.addCommand('lettrine', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '<span class="dropcap">' + selected_text + '</span>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });

/*            ed.addCommand('showrecent', function() {
                var number = prompt("How many posts you want to show ? "), 
                    shortcode;
                if (number !== null) {
                    number = parseInt(number);
                    if (number > 0 && number <= 20) {
                        shortcode = '[recent-posts numbers="' + number + '"/]';
                        ed.execCommand('mceInsertContent', 0, shortcode);
                    } else {
                        alert("The number value is invalid. It should be from 0 to 20.");
                    }
                }      
            });
*/            
            ed.addButton('youtube', {
                title : 'Ajouter une vid\351o YouTube',
                cmd : 'youtube',
                image : url + '/youtube.png'
            });

            ed.addButton('vimeo', {
                title : 'Ajouter une vid\351o Vim\351o',
                cmd : 'vimeo',
                image : url + '/vimeo.png'
            });

            ed.addButton('daily', {
                title : 'Ajouter une vid\351o DailyMotion',
                cmd : 'daily',
                image : url + '/daily.png'
            });

            ed.addButton('lettrine', {
                title : 'Transformer le caract\350re s\351lectionn\351 en Lettrine',
                cmd : 'lettrine',
                image : url + '/dropcap.png'
            });
            /*ed.addButton('showrecent', {
                title : 'Add recent posts shortcode',
                cmd : 'showrecent',
                image : url + '/recent.png'
            });*/
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                    longname : 'WPTuts Buttons',
                    author : 'Lee',
                    authorurl : 'http://wp.tutsplus.com/author/leepham',
                    infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                    version : "0.1"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('wptuts', tinymce.plugins.WPTuts);
})();