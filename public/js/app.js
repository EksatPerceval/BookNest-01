// Mobile Menu Toggle
document.addEventListener("DOMContentLoaded", () => {
  const navbarToggle = document.querySelector(".navbar-toggle")
  const navbarMenu = document.querySelector(".navbar-menu")

  if (navbarToggle) {
    navbarToggle.addEventListener("click", () => {
      navbarMenu.classList.toggle("active")
    })
  }

  // Close mobile menu when clicking outside
  document.addEventListener("click", (event) => {
    if (navbarMenu && navbarMenu.classList.contains("active")) {
      if (!event.target.closest(".navbar-container")) {
        navbarMenu.classList.remove("active")
      }
    }
  })

  // Favorite Toggle
  const favoriteButtons = document.querySelectorAll(".favorite-btn")
  favoriteButtons.forEach((button) => {
    button.addEventListener("click", async function (e) {
      e.preventDefault()

      const bookId = this.dataset.bookId
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content

      try {
        const response = await fetch("/favorites/toggle", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            Accept: "application/json",
          },
          body: JSON.stringify({ book_id: bookId }),
        })

        const data = await response.json()

        if (data.status === "added") {
          this.classList.add("active")
          this.textContent = "★ Hapus dari Favorit"
        } else {
          this.classList.remove("active")
          this.textContent = "☆ Tambah ke Favorit"
        }

        // Show notification
        showNotification(data.message)
      } catch (error) {
        console.error("Error:", error)
        showNotification("Terjadi kesalahan", "error")
      }
    })
  })

  // Delete Confirmation
  const deleteButtons = document.querySelectorAll(".btn-delete")
  deleteButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      if (!confirm("Apakah Anda yakin ingin menghapus item ini?")) {
        e.preventDefault()
      }
    })
  })

  // Image Preview on Upload
  const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]')
  imageInputs.forEach((input) => {
    input.addEventListener("change", (e) => {
      const file = e.target.files[0]
      if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
          let preview = input.parentElement.querySelector(".image-preview")
          if (!preview) {
            preview = document.createElement("div")
            preview.className = "image-preview"
            input.parentElement.appendChild(preview)
          }
          preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`
        }
        reader.readAsDataURL(file)
      }
    })
  })

  // Auto-hide alerts
  const alerts = document.querySelectorAll(".alert")
  alerts.forEach((alert) => {
    setTimeout(() => {
      alert.style.transition = "opacity 0.5s"
      alert.style.opacity = "0"
      setTimeout(() => alert.remove(), 500)
    }, 5000)
  })
})

// Notification Function
function showNotification(message, type = "success") {
  const notification = document.createElement("div")
  notification.className = `alert alert-${type}`
  notification.textContent = message
  notification.style.position = "fixed"
  notification.style.top = "20px"
  notification.style.right = "20px"
  notification.style.zIndex = "9999"
  notification.style.minWidth = "300px"

  document.body.appendChild(notification)

  setTimeout(() => {
    notification.style.transition = "opacity 0.5s"
    notification.style.opacity = "0"
    setTimeout(() => notification.remove(), 500)
  }, 3000)
}

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault()
    const target = document.querySelector(this.getAttribute("href"))
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      })
    }
  })
})
