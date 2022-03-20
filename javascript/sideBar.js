document.querySelector('.menu').addEventListener('click', () => {
  if (document.querySelector('.menu-drop').classList.contains('display')) {
    document.querySelector('.menu-drop').classList.remove('display')
  } else {
    document.querySelector('.menu-drop').classList.add('display')
  }
})
