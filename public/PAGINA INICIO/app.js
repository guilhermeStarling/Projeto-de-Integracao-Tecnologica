function changeContent(content) {
    const templateContent = document.getElementById('template-content');
    const profileContent = document.getElementById('profile-content');    


    switch (content) {
      case 1:
        templateContent.style.display = "none";

        profileContent.style.display = "block";
        break;
      case 2:
        profileContent.style.display = "none";

        templateContent.style.display = "block";
        break;
      default:
        break;
    }
  }


  window.addEventListener('DOMContentLoaded', () => {
    const openPopupBtn = document.getElementById('open-popup');
    const popup = document.getElementById('popupSaveArchive');
    const closePopupBtn = document.getElementById('close-popup');

    openPopupBtn.addEventListener('click', () => {
        popup.style.display = 'flex';
    });

    closePopupBtn.addEventListener('click', () => {
        popup.style.display = 'none';
    });
    
    const fileInput = document.getElementById('arquivo');
    fileInput.addEventListener('change', () => {
        const fileName = fileInput.value.split('\\').pop();
        document.getElementById('file-name').textContent = fileName;
    });
});

