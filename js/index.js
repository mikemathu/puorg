const treeview = document.getElementById('treevieww');
const  treeview_menu = document.querySelectorAll('#treeview-menu');


//remove class active from menu
// function resetMenu(){
//   treeview.classList.remove('active');
//   treeview_menu.classList.remove('active');
// }

function dispalyForm(){
  treeview.classList.add('active');
}

//Show bank form
function treeView(){


  treeview.classList.add('active');
}

//Show card form
function treeviewMenu(){
  
  resetMenu();
  treeview_menu.classList.add('active');
}

//treeview click
treeview.addEventListener('click',function(){
  treeView();
  
});

//treeview-menu click
treeview_menu.addEventListener('click',function(){
  treeviewMenu();
});


