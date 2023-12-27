
    const sections = document.querySelectorAll('section');
    const locationTeller = document.querySelector('.location');
    const backgrounds = ['aqua', 'chocolate', '#343434'];
    const options = {
        threshold: 0.7
    }
    let observer = new IntersectionObserver(navCheck, options);
    function navCheck(entries) {
        entries.forEach(entry => {
            const className = entry.target.className;
            const activeAnchor = document.querySelector(`[data-page=${className}]`);
            const gradientIndex = entry.target.getAttribute('data-index');
            const coords = activeAnchor.getBoundingClientRect();
            const directions = {
                height: coords.height,
                width: coords.width,
                top: coords.top,
                left: coords.left
            };
            if (entry.isIntersecting) {
                locationTeller.style.setProperty('left', `${directions.left}px`);
                locationTeller.style.setProperty('height', `${directions.height}px`);
                locationTeller.style.setProperty('width', `${directions.width}px`);
                //locationTeller.style.setProperty('top', `${directions.top}px`);
                locationTeller.style.backgroundColor = backgrounds[gradientIndex];
            }
        });
    }
    sections.forEach(section => {
        observer.observe(section);
    });