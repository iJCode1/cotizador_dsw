let hamburgerButton = document.getElementById("icon-hamburger")
let nav = document.getElementById('navv')

hamburgerButton.addEventListener("click", () => {
  let navOptions = document.getElementById('navv-options')
  navOptions.classList.toggle('is-visible')

  nav.classList.toggle('is-full')
})

let hamburgerButtonD = document.getElementById("icon-hamburgerD")
let navLinks = document.getElementsByClassName("link-text")

hamburgerButtonD.addEventListener('click', () => {
  if(navLinks.length >= 0){
    for(let link of navLinks){
      link.classList.toggle('is-hide')
    }
  }
  nav.classList.toggle('is-small')
})