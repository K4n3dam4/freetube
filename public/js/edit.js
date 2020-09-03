const URLROOT = 'http://localhost:8080/freetube/';

// categories
function openCatEdit(button) {
  let editForm = document.querySelector('#cat-form')
  let editTitle = document.querySelectorAll('.edit-cat-title');
  let catTitle = document.querySelectorAll('.cat-title');

  let openCatEdit = document.querySelectorAll('.open-cat-edit');
  let submitEdit = document.querySelectorAll('.submit-edit');

  let index = button.getAttribute('data-index');
  let form;
  let title;
  let submit;

  editTitle.forEach(element => {
    element.classList.add('d-none');
    element.removeAttribute('name');
    if (element.getAttribute('data-index') == index) {
      form = element;
    }
  });

  catTitle.forEach(element => {
    element.classList.remove('d-none');
    if (element.getAttribute('data-index') == index) {
      title = element;
    }
  });

  submitEdit.forEach(element => {
    element.classList.add('d-none');
    element.removeAttribute('name');
    if (element.getAttribute('data-index') == index) {
      submit = element;
    }
  })

  openCatEdit.forEach(element => {
    element.classList.remove('d-none');
    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
    }
  })

  submit.classList.toggle('d-none');
  submit.setAttribute('name', 'edit-cat-id');

  title.classList.toggle('d-none');

  form.classList.toggle('d-none');
  form.setAttribute('name', 'edit');

  editForm.setAttribute('action', URLROOT + 'admin/edit_cat');
}

function openChannelEdit(button) {
  let editChannel = document.querySelectorAll('.edit-channel');
  let tableContent = document.querySelectorAll('.channel-table-content');

  // buttons
  let openEdit = document.querySelectorAll('.open-channel-edit');
  let submitEdit = document.querySelectorAll('.submit-edit');

  let index = button.getAttribute('data-index');

  tableContent.forEach(element => {
    element.classList.remove('d-none');
    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
    }
  });

  openEdit.forEach(element => {
    element.classList.remove('d-none');
    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
    }
  });

  submitEdit.forEach(element => {
    element.removeAttribute('name');
    element.classList.add('d-none');
    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
      element.setAttribute('name', 'channel-id');
    }
  });

  // new nodelists
  let editChannelMatch = new Array;

  editChannel.forEach(element => {
    element.removeAttribute('name');
    element.classList.add('d-none');

    if (element.getAttribute('data-index') == index) {
      editChannelMatch.push(element);
    }
  });


  for (let i = 0; i < editChannelMatch.length; i++) {
    editChannelMatch[i].classList.toggle('d-none');
    editChannelMatch[0].setAttribute('name', 'is-admin');
    editChannelMatch[1].setAttribute('name', 'channel-name');
    editChannelMatch[2].children[0].setAttribute('name', 'img');
    editChannelMatch[3].setAttribute('name', 'channel-owner');
    editChannelMatch[4].setAttribute('name', 'channel-email');
  }
}

function openVideoEdit(button) {
  let editVideo = document.querySelectorAll('.edit-video');
  let tableContent = document.querySelectorAll('.video-table-content');

  // buttons
  let openEdit = document.querySelectorAll('.open-video-edit');
  let submitEdit = document.querySelectorAll('.submit-edit');

  let index = button.getAttribute('data-index');

  tableContent.forEach(element => {
    element.classList.remove('d-none');
    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
    }
  });

  openEdit.forEach(element => {
    element.classList.remove('d-none');
    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
    }
  });

  submitEdit.forEach(element => {
    element.removeAttribute('name');
    element.classList.add('d-none');
    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
      element.setAttribute('name', 'vid-id');
    }
  });

  // new nodelists
  let editVideoMatch = new Array;

  editVideo.forEach(element => {
    element.removeAttribute('name');
    element.classList.add('d-none');

    if (element.getAttribute('data-index') == index) {
      editVideoMatch.push(element);
    }
  });

  for (let i = 0; i < editVideoMatch.length; i++) {
    editVideoMatch[i].classList.toggle('d-none');
    editVideoMatch[0].setAttribute('name', 'vid-title');
    editVideoMatch[1].setAttribute('name', 'vid-category');
    editVideoMatch[2].setAttribute('name', 'vid-tags');
    editVideoMatch[3].children[0].setAttribute('name', 'video');
    editVideoMatch[4].setAttribute('name', 'vid-com-count');
    editVideoMatch[5].setAttribute('name', 'vid-like-count');
  }
}

function openCommentEdit(button) {
  let editComment = document.querySelectorAll('.edit-comment');
  let tableContent = document.querySelectorAll('.comment-table-content');

  // buttons
  let openEdit = document.querySelectorAll('.open-comment-edit');
  let submitEdit = document.querySelectorAll('.submit-edit');

  let index = button.getAttribute('data-index');

  tableContent.forEach(element => {
    element.classList.remove('d-none');
    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
    }
  });

  openEdit.forEach(element => {
    element.classList.remove('d-none');
    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
    }
  });

  submitEdit.forEach(element => {
    element.removeAttribute('name');
    element.classList.add('d-none');
    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
      element.setAttribute('name', 'com-id');
    }
  });

  // new nodelists
  let editCommentMatch = new Array;

  editComment.forEach(element => {
    element.removeAttribute('name');
    element.classList.add('d-none');

    if (element.getAttribute('data-index') == index) {
      element.classList.toggle('d-none');
      element.setAttribute('name', 'com-content');
    }
  });
}