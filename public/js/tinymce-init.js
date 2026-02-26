tinymce.init({
  selector: 'textarea',
  plugins: 'lists link code',
  toolbar: 'undo redo | blocks | bold italic | bullist numlist | link | removeformat | code',
  block_formats: 'Paragraphe=p; Titre 2=h2; Titre 3=h3; Titre 4=h4; Titre 5=h5; Titre 6=h6',
  menubar: false,
  branding: false,
  setup: function (editor) {
    editor.on('change', function () {
      editor.save(); // synchronise vers le textarea original
    });
  }
});

// Validation avant soumission
document.querySelector('form').addEventListener('submit', function (e) {
  tinymce.triggerSave(); // force la sync de tous les éditeurs

  const content = document.querySelector('[name="content"]').value.trim();
  if (!content || content === '<p></p>' || content === '<p><br></p>') {
    e.preventDefault();
    alert('Le champ contenu est obligatoire.'); // ou ton propre message d'erreur
  }
});