$(function() {
  'use strict';

  // Tinymce editor
  if ($("#editor").length) {
    tinymce.init({
      selector: '#editor',
      language: 'pt_BR',
      min_height: 600,
      skin: 'oxide',
      plugins: [
        'advlist', 'autoresize', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'pagebreak',
        'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'table', // Adicionando o plugin 'table'
      ],
      toolbar1: 'undo redo | styleselect | fontselect | fontsizeselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist | link image | table', // Personalizando a barra de ferramentas para um escritor
      toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
      image_advtab: true,
      
      templates: [{
          title: 'Test template 1',
          content: 'Test 1'
        },
        {
          title: 'Test template 2',
          content: 'Test 2'
        }
      ],
      content_css: [],
      content_style: "body { background: aliceblue; }",
      setup: function(editor) {
          editor.on('init', function() {
              // Adiciona espaçamento entre colunas
              var contentBody = editor.getBody();
              contentBody.style.padding = '0 10px'; // 10px de espaçamento à esquerda e à direita
              
              // Torna a barra de ferramentas pegajosa após a rolagem
              var toolbar = editor.editorContainer.parentElement.querySelector('.tox-toolbar');
              toolbar.style.position = 'sticky';
              toolbar.style.top = '0';
              toolbar.style.zIndex = '1000';
          });
      }
    });
  }

});
