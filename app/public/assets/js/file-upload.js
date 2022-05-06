const readFile = async function (input) {
  if (input.files && input.files[0]) {
    let reader = new FileReader()
    reader.onload = (e) => {
      document
        .querySelector('#profile_picture')
        .setAttribute('src', e.target.result)
    }
    reader.readAsDataURL(input.files[0])
  }
}

document.querySelector('#user_avatar').addEventListener('change', function () {
  readFile(this)
})
