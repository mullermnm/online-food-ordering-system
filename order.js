const foodCatagoriesSlide = () => {
    const foodCatagoriesToggle = document.querySelector(".food-catagories-toggle");
    const foodCatagoriesUl = document.querySelector(".food-catagories");
    foodCatagoriesToggle.addEventListener('click', () => {
        foodCatagoriesUl.classList.toggle('food-catagories-active');
        foodCatagoriesToggle.classList.toggle('closer');
    })
} 
foodCatagoriesSlide();