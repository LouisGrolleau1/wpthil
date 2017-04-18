// JavaScript Document
(function() {
tinymce.create('tinymce.plugins.youtube',{
	init:function(ed,url){
		ed.addButton('youtube',{
			title: 'Ajouter une video YouTube',
			image: url+'/youtube.png',
			onclick:function() {
				var youtubeID=prompt('Id de la vidéo YouTube: ','');
				ed.selection.setContent('[youtube id='+youtubeID+']');		
			}
		});

	},
	createControl : function(n, cm) {
               return null;
          },
	
});
tinymce.PluginManager.add('youtube','tinymce.plugins.youtube');
})();