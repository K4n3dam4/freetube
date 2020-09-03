// wrapper
let channelWrapper = document.querySelector('.channel-wrapper');
let channelBody = document.getElementsByTagName('BODY')[0];

// channel upload / manage videos
let channelControls = document.querySelectorAll('.channel-menu');
let channelUpload = document.querySelector('#chnnael-upload');
let channelUploadBtns = document.querySelectorAll(".upload");
let channelManage = document.querySelector('#channel-manage');

// search
let channelSearchInput = document.querySelector('#search-channel-input');
let channelOpen = document.querySelector('#open-channel-search');
let channelClose =document.querySelector('#close-channel-search');
let channelSearchSubmit = document.querySelector('#search-channel-submit');

// upload
let uploadForm = document.querySelector('.channel-upload-form');

// manage
let deleteVideo = document.querySelectorAll('.delete-video');
let toggleEdit = document.querySelectorAll('.toggle-edit'); 
let editForm = document.querySelectorAll('.channel-edit-form');

// =====================

// Open search
channelOpen.addEventListener('click', function() {
  channelOpen.classList.toggle('d-none');
  channelSearchSubmit.classList.toggle('d-none');
  setTimeout(function() {
    channelClose.classList.toggle('d-none');
  }, 300);
  channelSearchInput.classList.toggle('animateSearch');
  channelControls.forEach(element => {
    element.classList.toggle('d-none');
  });
})
// Close search
channelClose.addEventListener('click', function() {
  channelOpen.classList.toggle('d-none');
  channelSearchSubmit.classList.toggle('d-none');
  channelClose.classList.toggle('d-none');
  channelSearchInput.classList.toggle('animateSearch');
  channelControls.forEach(element => {
    element.classList.toggle('d-none');
  });
})

// ==================

let isOpenUpload = false;

// open upload form
channelUploadBtns.forEach(element => {
  element.addEventListener('click', function() {
    if (isOpenUpload == false) {
      channelUpload.innerHTML = "Close";
      channelBody.classList.toggle('overflow-hidden');
      uploadForm.classList.toggle('animateUpload');
      isOpenUpload = true;
    } else {
      channelUpload.innerHTML = "Upload";
      channelBody.classList.toggle('overflow-hidden');
      uploadForm.classList.toggle('animateUpload');
      isOpenUpload = false;
    }
  })
});

// ================

let isOpenManage = false;

// open manage controls
channelManage.addEventListener('click', function() {
  if (isOpenManage == false) {
    deleteVideo.forEach(element => {
      element.classList.toggle('d-none');
    });
    toggleEdit.forEach(element => {
      element.classList.toggle('d-none');
    })
    channelManage.innerHTML = 'Close';
    isOpenManage = true;
  } else {
    deleteVideo.forEach(element => {
      element.classList.toggle('d-none');
    });
    toggleEdit.forEach(element => {
      element.classList.toggle('d-none');
      element.innerHTML = 'Edit';
      element.classList.remove('btn-danger');
      element.classList.add('btn-success');
    })
    editForm.forEach(element => {
      element.classList.remove('animateEdit')
    });
    channelManage.innerHTML = 'Manage';
    isOpenManage = false;
  }
})

// open edit form
toggleEdit.forEach(element => {
  element.addEventListener('click', function() {
    let index = element.getAttribute('data-index');
    let form;
  
    editForm.forEach(element => {
      if (element.getAttribute('data-index') == index) {
        form = element;
      }
    });

    if (element.innerHTML == 'Edit') {
      element.innerHTML = 'Close';
      element.classList.toggle('btn-success');
      element.classList.toggle('btn-danger');
    } else {
      element.innerHTML = 'Edit';
      element.classList.toggle('btn-success');
      element.classList.toggle('btn-danger');
    }

    form.classList.toggle('animateEdit');
  })
})