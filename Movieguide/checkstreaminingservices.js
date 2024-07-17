let uTellyEndPoint = uTellyURL(movie.imdbID);
$.ajax(uTellyEndPoint, settings)
    .then(function (response) {
        // If the user is logged in, fetch their streaming services from the database
        if (userIsLoggedIn()) {
            $.ajax('/path/to/streaming_services_endpoint.php', {
                method: 'GET',
                dataType: 'json'
            })
            .done(function(userServices) {
                compareStreamingServices(response.collection.locations, userServices);
            });
        } else {
            showStreamingServices(response.collection.locations);
        }
    })
    .catch(function (err) {
        console.log(err);
    });

// When the user clicks on <span> (x), close the modal
$('.close').click(function () {
    modal.style.display = 'none';
});

function userIsLoggedIn() {
    // Check if the user is logged in. This could be a session check, or a check on a global variable.
    // Return true if logged in, false if not. For this example, I'm assuming a global variable `loggedIn`.
    return window.loggedIn === true; 
}

function compareStreamingServices(apiServices, userServices) {
    apiServices.forEach(function (streamingLocation) {
        if (userServices.includes(streamingLocation.name)) { // assuming each service has a 'name' property
            let liEl = `<li><a href="${streamingLocation.url}" target="_blank"><img id="modal-logo" src="${streamingLocation.icon}"/></a></li>`;
            $('#streaming-services').append(liEl);
        } else {
            let liEl = `<li>${streamingLocation.name} is not available for you.</li>`;
            $('#streaming-services').append(liEl);
        }
    });
}

function showStreamingServices(apiServices) {
    if (apiServices.length !== 0) {
        apiServices.forEach(function (streamingLocation) {
            let liEl = `<li><a href="${streamingLocation.url}" target="_blank"><img id="modal-logo" src="${streamingLocation.icon}"/></a></li>`;
            $('#streaming-services').append(liEl);
        });
    } else {
        let liEl = `<li>This movie is not available for streaming</li>`;
        $('#streaming-services').append(liEl);
    }
}
