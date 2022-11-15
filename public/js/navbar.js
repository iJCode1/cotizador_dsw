let hamburgerButton = document.getElementById("icon-hamburger")

hamburgerButton.addEventListener("click", () => {
  let navOptions = document.getElementById('nav-options')
  navOptions.classList.toggle('is-visible')

  let nav = document.getElementById('nav')
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