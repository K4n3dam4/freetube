let comment = document.querySelector('.comment');
let displayComment = document.querySelector('.display-comment');
let commentButtons = document.querySelectorAll('.comment-btn');
let commentSubmit = document.querySelector('.comment-submit');
let commentCancel = document.querySelector('.comment-cancel');

let commentOpen = false;

function toggleComment() {
  if (comment.getAttribute('placeholder') == 'Leave a comment') {
    comment.setAttribute('placeholder', '');
  } else {
    comment.setAttribute('placeholder', 'Leave a comment');
  }
  comment.classList.toggle('commentAnimate');
  commentButtons.forEach(element => {
    element.classList.toggle('d-none');
  });
}
comment.addEventListener('focus', function() {
  if (commentOpen == false) {
    toggleComment();
    commentOpen = true;
  }
})
commentCancel.addEventListener('click', function() {
  if (commentOpen == true) {
    toggleComment();
    commentOpen = false;
  }
});


// edit comment

function editComment() {
  let openComEdit = document.querySelectorAll('.com-open-edit');
  let comEditForm = document.querySelectorAll('.com-edit-form');
  let comEditClose = document.querySelectorAll('.com-edit-cancel')
  let comCont = document.querySelectorAll('.comments-cont');

  openComEdit.forEach(el => {
    el.addEventListener('click', function() {
      let index = el.getAttribute('data-index');
      let editForm;
      let comment;

      comEditForm.forEach(el => {
        if (el.getAttribute('data-index') == index) {
          editForm = el;
        }
      });

      comCont.forEach(el => {
        if (el.getAttribute('data-index') == index) {
          comment = el;
        }
      });

      editForm.classList.toggle('d-none');
      comment.classList.toggle('d-none');
    })
  });

  comEditClose.forEach(el => {
    el.addEventListener('click', function () {
      let index = el.getAttribute('data-index');
      let editForm;
      let comment;

      comEditForm.forEach(el => {
        if (el.getAttribute('data-index') == index) {
          editForm = el;
        }
      });

      comCont.forEach(el => {
        if (el.getAttribute('data-index') == index) {
          comment = el;
        }
      });

      editForm.classList.toggle('d-none');
      comment.classList.toggle('d-none');
    })

  });
}

// function echoListeners() {
//   (document=>{
//     const all={};
//     for(let tag of document.querySelectorAll('*')) {
//         const events=getEventListeners(tag);
//         if(Object.keys(events).length) {
//             for(let [event,listeners] of Object.entries(events))
//                 for(let listener of listeners)tag.removeEventListener(listener.type,listener.listener,listener.useCapture);
//             const path=(node=>{
//                 const parts=[];
//                 while(node.parentNode!==null) {
//                     parts.push(`${node.nodeName}[${[...node.parentNode.children].indexOf(node)}]`);
//                     node=node.parentNode
//                 }
//                 return parts.reverse()
//             })(tag),name=path.pop();
//             let node=all;
//             for(let part of path) {
//                 if(!(part in node))node[part]={};
//                 node=node[part];
//             }
//             node[name]=[tag, events]
//         }
//     }
//     return all
//   })(document)
// }
// let openComEdit = document.querySelectorAll('.com-open-edit');
// let comEditForm = document.querySelectorAll('.com-edit-form');
// let comEditClose = document.querySelectorAll('.com-edit-cancel')
// let comCont = document.querySelectorAll('.comments-cont');

// openComEdit.forEach(el => {
//   el.addEventListener('click', function() {
//     let index = el.getAttribute('data-index');
//     let editForm;
//     let comment;

//     comEditForm.forEach(el => {
//       if (el.getAttribute('data-index') == index) {
//         editForm = el;
//       }
//     });

//     comCont.forEach(el => {
//       if (el.getAttribute('data-index') == index) {
//         comment = el;
//       }
//     });

//     editForm.classList.toggle('d-none');
//     comment.classList.toggle('d-none');
//   })
// });

// comEditClose.forEach(el => {
//   el.addEventListener('click', function () {
//     let index = el.getAttribute('data-index');
//     let editForm;
//     let comment;

//     comEditForm.forEach(el => {
//       if (el.getAttribute('data-index') == index) {
//         editForm = el;
//       }
//     });

//     comCont.forEach(el => {
//       if (el.getAttribute('data-index') == index) {
//         comment = el;
//       }
//     });

//     editForm.classList.toggle('d-none');
//     comment.classList.toggle('d-none');
//   })

// })