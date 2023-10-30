const stayOnCurrentPageLink = document.querySelectorAll(".stayOnCurrentPage");

for (let i = 0; i < stayOnCurrentPageLink.length; i++) {
  stayOnCurrentPageLink[i].addEventListener("click", function (event) {
    event.preventDefault();
  });
}
// Get references to the elements
// const showModalButton = document.getElementById("showModalBtn");
// const updateModal = document.getElementById("updateModal");

// // Add a click event listener to the "Show Modal" button
// showModalButton.addEventListener("click", function () {
//   // Show the modal by changing its style to "block"
//   updateModal.style.display = "block";
// });

// // Add an event listener to close the modal when the close button is clicked
// const closeModalButton = document.getElementById("closeModalBtn");
// closeModalButton.addEventListener("click", function () {
//   // Hide the modal by changing its style to "none"
//   updateModal.style.display = "none";
// });

// // Add an event listener to close the modal when clicking outside of it
// window.addEventListener("click", function (event) {
//   if (event.target === updateModal) {
//     updateModal.style.display = "none";
//   }
// });
