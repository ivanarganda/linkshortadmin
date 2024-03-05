if ( document.getElementById('toggleButton') ){
    document.getElementById('toggleButton').addEventListener('click', function () {
        // Toggle visibility of child elements
        var childElements = document.getElementById('childElements');
        if (childElements.classList.contains('hidden')) {
            childElements.classList.remove('hidden');
        } else {
            childElements.classList.add('hidden');
        }
    });
}

let toogled = false;
document.getElementById('toggleSidebar').addEventListener('click', function () {
    
    if(!toogled){
        $("#sidebar").addClass('left-0').removeClass('-left-full');
        $("#overlay").removeClass('hidden');
        toogled = true;
    } else { 
        $("#sidebar").removeClass('left-0').addClass('-left-full');
        $("#overlay").addClass('hidden');
        toogled = false;
    }

});