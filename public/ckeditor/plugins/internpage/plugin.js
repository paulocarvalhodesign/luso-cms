/**************************************
    Webutler V2.1 - www.webutler.de
    Copyright (c) 2008 - 2011
    Autor: Sven Zinke
    Free for any use
    Lizenz: GPL
**************************************/

(function(){CKEDITOR.plugins.add('internpage',{lang:[CKEDITOR.lang.detect(CKEDITOR.config.language)]});CKEDITOR.scriptLoader.load(CKEDITOR.plugins.getPath('internpage')+'pages.php');CKEDITOR.on('dialogDefinition',function(a){var b=a.data.name,c=a.data.definition,d=a.editor;if(b=='link'){var e=c.getContents('info');e.add({type:'select',id:'intern',label:d.lang.internpage.internpage,'default':'',style:'width:100%',items:InternPagesSelectBox,onChange:function(){var f=CKEDITOR.dialog.getCurrent();f.setValueOf('info','url',this.getValue());f.setValueOf('info','protocol',!this.getValue()?'http://':'');},setup:function(f){this.allowOnChange=false;this.setValue(f.url?f.url.url:'');this.allowOnChange=true;}},'browse');c.onLoad=function(){var f=this.getContentElement('info','intern');f.reset();};}});})();
