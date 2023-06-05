document.addEventListener("DOMContentLoaded", () => {
    const movieForm = document.getElementById("movie_form");
    const statusMessage = document.getElementById("movie_status_message");
  
    movieForm.addEventListener("submit", (e) => {
        e.preventDefault();
      
        const formData = new FormData(movieForm);
        const body = new URLSearchParams(formData).toString();
      
        fetch("controllers/create.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: body
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === "OK") {
                movieForm.reset();
                statusMessage.textContent = "Movie added successfully";
            } else {
                statusMessage.textContent = "Error adding movie, please try again";
            }
        });
    });
});