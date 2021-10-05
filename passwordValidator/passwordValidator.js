const validate = document.getElementById("val")
const usr = document.getElementById("us")
const pwd = document.getElementById("pw")

validate.onclick = function () {
  document.getElementById("notStrong").innerHTML = ``
  const user = usr.value
  const pass = pwd.value
  validateInput(user, pass)
  let validity = isPasswordValid(user, pass)
  let strength = isPasswordStrong(user, pass)

  if (validity === false) {
    pwd.value = ""
    usr.value = ""
    pwd.removeAttribute("placeholder")
    usr.removeAttribute("placeholder")
    document.getElementById("notStrong").style.color = "red"
    document.getElementById(
      "notStrong"
    ).innerHTML = `Enter a new password. Password not valid! :(`
  }

  if (strength === false) {
    pwd.value = " "
    usr.value = " "
    pwd.removeAttribute("placeholder")
    usr.removeAttribute("placeholder")
    document.getElementById("notStrong").style.color = "red"
    document.getElementById(
      "notStrong"
    ).innerText = `Password can't contain more than 3 characters from the username.`
  }

  if (validity && strength) {
    pwd.value = ""
    usr.value = ""
    pwd.removeAttribute("placeholder")
    usr.removeAttribute("placeholder")
    document.getElementById("notStrong").style.color = "green"
    document.getElementById(
      "notStrong"
    ).innerHTML = `Valid Password! Type in different values to try again:)`
  }
}

function validateInput(user, pass) {
  if (user === null || user === "" || pass === "" || pass === null) {
    alert("Please enter username and password")
  }
}

function isPasswordValid(un, ps) {
  const hasSpecial = (str) => {
    let spl = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/
    return spl.test(str)
  }

  const hasNum = (str) => {
    return /\d/.test(str)
  }

  const hasLower = (str) => {
    return str.toUpperCase() != str
  }

  const hasUpper = (str) => {
    return str.toLowerCase() != str
  }

  let len = ps.length
  let up = hasUpper(ps)
  let low = hasLower(ps)
  let spl = hasSpecial(ps)
  let num = hasNum(ps)

  console.log(
    `len: ${len} (min should be 8), up: ${up}, low:${low}, spl:${spl}, num:${num}`
  )

  if (len >= 8 && up && low && spl && num) {
    return true
  }
  return false
}

function isPasswordStrong(user, pass) {
  const numrepeated = (str1, str2) => {
    let count = 0
    const obj = str2.split("")
    for (str of str1) {
      let idx = obj.findIndex((s) => s === str)
      if (idx >= 0) {
        count++
        obj.splice(idx, 1)
      }
    }
    return count
  }
  let sameChar = numrepeated(user, pass)

  if (sameChar > 3) {
    return false
  }
  return true
}

usr.onclick = function () {
  usr.removeAttribute("placeholder")
}

pwd.onclick = function () {
  pwd.removeAttribute("placeholder")
}
