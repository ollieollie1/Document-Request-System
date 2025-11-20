    
//dropdown profile
    const profileMenu = document.getElementById('profile-menu');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const profileName = document.getElementById('profile-name');
    const profileIcon = document.querySelector('.profile-icon');

    function toggleDropdown() {
      dropdownMenu.classList.toggle('show');
    }

    // Click either name or profile picture
    profileIcon.addEventListener('click', toggleDropdown);
    profileName.addEventListener('click', toggleDropdown);

    // Close dropdown if clicked outside
    window.addEventListener('click', (e) => {
      if (!profileMenu.contains(e.target)) dropdownMenu.classList.remove('show');
    });