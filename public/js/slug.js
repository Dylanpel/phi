//slugification automatique des titres dans les formulaires
document.querySelector('[name="title"]').addEventListener('input', function () {
  document.querySelector('[name="slug"]').value = this.value
    .toLowerCase()
    .normalize('NFD')                  // décompose les accents (é → e + ́)
    .replace(/[\u0300-\u036f]/g, '')   // supprime les diacritiques
    .replace(/[^a-z0-9\s-]/g, '')      // garde lettres, chiffres, espaces, tirets
    .trim()
    .replace(/[\s]+/g, '-')            // espaces → tirets
    .replace(/-+/g, '-');              // tirets multiples → un seul
});