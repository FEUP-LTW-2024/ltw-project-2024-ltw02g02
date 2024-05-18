function confirmDeletion(event) {
    var userConfirmed = confirm("Are you sure you want to delete this listing?");
    if (!userConfirmed) {
        event.preventDefault();
    }
    return userConfirmed;
}