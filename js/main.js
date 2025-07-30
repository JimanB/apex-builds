/**
 * Main JavaScript file for Apex Builds
 * Author: Jimaan Bajwa Singh
 * Date: July 1, 2025
 *
 * This script handles:
 * 1. Theme switching and persistence.
 * 2. Responsive mobile navigation.
 * 3. Fetching and displaying product data.
 * 4. API call for live weather data.
 * 5. Page-specific logic initialization.
 */

//wait for the DOM to be fully loaded before running any scripts
document.addEventListener('DOMContentLoaded', () => {

    //global initalizatoins
    initializeThemeSwitcher();
    initializeMobileMenu();
    initializePasswordToggles();
    fetchWeather(); //fetches weather for the footer widget
    updateCartIconCount();

    //page specific initializations
    //run certain functions only if we are on the correct page
    if (document.getElementById('featured-grid')) {
        populateFeaturedProducts();
    }

    //we will add more for the builder page later
     if (document.getElementById('builder-form')) {
         initializeBuilder();
    }
/*
    if (document.getElementById('contact-form')) {
        initializeContactForm();
    }
*/

    //product Listing pages (like cpu.php, gpu.php, etc.)
    if (document.body.dataset.category) {
        initializeProductPage();
    }
});

/**
 * handles the theme switcher dropdown.
 * it saves a path-independent 'key' (e.g., "synthwave") to localStorage.
 * on page load, it finds the option with the saved key and applies its value,
 * which contains the correct relative path for the current page.
 */
function initializeThemeSwitcher() {
    const themeSelect = document.getElementById('theme-select');
    if (!themeSelect) return; //exit if no theme switcher on page

    const themeStylesheet = document.getElementById('theme-stylesheet');
    const savedThemeKey = localStorage.getItem('theme_key') || 'default'; //get saved key or use 'default'

    //find the option that matches the saved key and apply its path
    for (const option of themeSelect.options) {
        if (option.dataset.key === savedThemeKey) {
            themeStylesheet.setAttribute('href', option.value);
            themeSelect.value = option.value;
            break;
        }
    }

    //add event listener to save the KEY on change, not the path
    themeSelect.addEventListener('change', () => {
        const selectedOption = themeSelect.options[themeSelect.selectedIndex];
        const selectedThemePath = selectedOption.value;
        const selectedThemeKey = selectedOption.dataset.key;

        themeStylesheet.setAttribute('href', selectedThemePath);
        localStorage.setItem('theme_key', selectedThemeKey);
    });
}
/**
 * handles the click event for the hamburger menu on mobile devices.
 */
function initializeMobileMenu() {
    const hamburger = document.querySelector('.hamburger-menu');
    //jf the hamburger element doesn't exist on the page, exit the function.
    if (!hamburger) {
        return;
    }
    const navLinks = document.querySelector('.nav-links');

    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
}

/**
 * fetches the current cart item count and updates the icon badge.
 */
async function updateCartIconCount() {
    const countElement = document.getElementById('cart-item-count');
    if (!countElement) return;

    try {
        //const response = await fetch('php/api_cart_count.php');
        const response = await fetch(window.location.pathname.includes('/help/') ? '../php/api_cart_count.php' : 'php/api_cart_count.php');
        const data = await response.json();

        if (data.item_count > 0) {
            countElement.textContent = data.item_count;
            countElement.style.display = 'flex'; //show the badge
        } else {
            countElement.style.display = 'none'; //hide the badge
        }
    } catch (error) {
        console.error('Could not update cart count:', error);
    }
}
/**
 * fetches product data from the local JSON file.
 * @returns {Promise<Array|null>} A promise that resolves to the product data array, or null on error.
 */
async function getProducts() {
    try {
        const response = await fetch('php/api.php?action=get_products'); //adjusted path
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const products = await response.json();
        return products;
    } catch (error) {
        console.error("Could not fetch products:", error);
        return null;
    }
}

/**
 * populates the featured products grid on the homepage.
 */
async function populateFeaturedProducts() {
    const products = await getProducts();
    if (!products) return; //exit if products couldn't be fetched

    const featuredGrid = document.getElementById('featured-grid');
    //we'll feature the first 4 main components: CPU, GPU, Motherboard, RAM
    const featuredCategories = ['CPU', 'GPU', 'Motherboard', 'RAM'];

    let content = '';

    //find the specified categories and create a card for the first option
    featuredCategories.forEach(catName => {
        const category = products.find(p => p.category === catName);
        if (category && category.options.length > 0) {
            const featuredOption = category.options[0]; //get the first option
            content += `
                <div class="product-card">
                    <img src="${featuredOption.image}" alt="${featuredOption.name}">
                    <h3>${category.displayName}</h3>
                    <p>${featuredOption.name}</p>
                </div>
            `;
        }
    });

    featuredGrid.innerHTML = content;
}

/**
 * fetches weather data from OpenWeatherMap API and updates the widget.
 */
async function fetchWeather() {
    const weatherWidget = document.getElementById('weather-widget');
    if (!weatherWidget) return;

    const apiKey = 'b7636538f6afd603a22c35a7b06e2a16';
    const lat = '42.3149'; //latitude for Windsor, ON
    const lon = '-83.0364'; //longitude for Windsor, ON
    const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;

    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Weather data not available.');
        }
        const data = await response.json();

        //extract relevant data
        const temperature = Math.round(data.main.temp);
        const description = data.weather[0].description;
        const iconCode = data.weather[0].icon;
        const iconUrl = `https://openweathermap.org/img/wn/${iconCode}.png`;

        //update the widget's HTML
        weatherWidget.innerHTML = `
            <p><strong>Windsor, ON:</strong> ${temperature}°C</p>
            <img src="${iconUrl}" alt="${description}" style="vertical-align: middle; width: 40px;">
        `;
    } catch (error) {
        weatherWidget.innerHTML = `<p>Could not load weather data.</p>`;
        console.error('Error fetching weather:', error);
    }
}
/**
 * pc builder logic
 */

//global variable to store exchange rates to avoid fetching them every time
let exchangeRates = null;

/**
 * initializes all functionality for the PC Builder page.
 */
async function initializeBuilder() {
    const products = await getProducts();
    if (!products) {
        alert('Failed to load product data. Please try refreshing the page.');
        return;
    }

    populateBuilderForm(products);

    const builderForm = document.getElementById('builder-form');
    const currencySelect = document.getElementById('currency-select');

    //listen for changes on the entire form for price calculation
    builderForm.addEventListener('change', calculateTotal);

    //listen for changes on the currency dropdown
    currencySelect.addEventListener('change', updateConvertedPrice);

    //initial calculation
    calculateTotal();
}

/**
 * creates and injects the HTML for the component selection dropdowns.
 * sorts options by price and defaults to "None" where available.
 * @param {Array} products - The array of product data from the API.
 */
function populateBuilderForm(products) {
    const form = document.getElementById('builder-form');
    let content = '';

    products.forEach(category => {
        //sort the options by price, from cheapest to most expensive
        category.options.sort((a, b) => a.price - b.price);

        content += `
            <div class="component-row">
                <label for="${category.category}-select">${category.displayName}</label>
                <select name="${category.category}" id="${category.category}-select" class="component-select">
        `;

        //check if a "None" or similar default option exists for this category
        const noneOptionIndex = category.options.findIndex(option => 
            option.name.toLowerCase().includes('none') ||
            option.name.toLowerCase().includes('standard cables') ||
            option.name.toLowerCase().includes('onboard wi-fi')
        );
        
        category.options.forEach((option, index) => {
            //if a "None" option exists, make it the default selected option
            //otherwise, the cheapest option (now first) will be the default
            const isSelected = (noneOptionIndex !== -1 && index === noneOptionIndex) ? 'selected' : '';

            content += `<option value="${option.name}" data-price="${option.price}" ${isSelected}>${option.name} ($${option.price.toFixed(2)})</option>`;
        });
        
        content += `</select></div>`;
    });
    
    form.innerHTML += content;
}

/**
 * calculates the total price based on current selections and updates the display.
 */
function calculateTotal() {
    const selections = document.querySelectorAll('.component-select');
    let total = 0;

    selections.forEach(select => {
        const selectedOption = select.options[select.selectedIndex];
        const price = parseFloat(selectedOption.dataset.price); //get price from data attribute
        total += price;
    });

    const totalPriceElement = document.getElementById('total-price');
    totalPriceElement.textContent = `$${total.toFixed(2)}`;

    //after updating the total, also update the converted price display
    updateConvertedPrice();
}

/**
 * fetches the latest exchange rates from the API.
 * uses a free, no-key-required API endpoint.
 * @returns {Promise<Object|null>} A promise that resolves to the rates object.
 */
async function fetchExchangeRates() {
    //if we already have the rates, don't fetch them again
    if (exchangeRates) {
        return exchangeRates;
    }

    //this is a free API, no key required
    const apiUrl = 'https://api.exchangerate-api.com/v4/latest/CAD';

    try {
        const response = await fetch(apiUrl);
        if (!response.ok) throw new Error('Failed to fetch exchange rates.');
        const data = await response.json();
        exchangeRates = data.rates; //cache the rates
        return exchangeRates;
    } catch (error) {
        console.error("Error fetching exchange rates:", error);
        return null;
    }
}

/**
 * updates the converted price display based on the selected currency.
 */
async function updateConvertedPrice() {
    const rates = await fetchExchangeRates();
    if (!rates) {
        document.getElementById('converted-price-display').textContent = 'Could not load rates.';
        return;
    }

    const totalPriceText = document.getElementById('total-price').textContent;
    const cadTotal = parseFloat(totalPriceText.replace('$', ''));

    const currencySelect = document.getElementById('currency-select');
    const targetCurrency = currencySelect.value;

    const convertedPriceDisplay = document.getElementById('converted-price-display');

    if (targetCurrency === 'CAD') {
        convertedPriceDisplay.textContent = ''; //hide if CAD is selected
        return;
    }

    const rate = rates[targetCurrency];
    if (rate) {
        const convertedAmount = cadTotal * rate;
        convertedPriceDisplay.textContent = `Approx. ${convertedAmount.toFixed(2)} ${targetCurrency}`;
    } else {
        convertedPriceDisplay.textContent = `Rate for ${targetCurrency} not available.`;
    }
}

/**
 * contact form logic
 */

/**
 * initializes the contact form by adding a submit event listener.
 */
 /*
function initializeContactForm() {
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', handleContactSubmit);
    }
}*/

/**
 * handles the contact form submission event.
 * @param {Event} event - The form submission event object.
 */
 /*
function handleContactSubmit(event) {
    //prevent the default form submission (which reloads the page)
    event.preventDefault();

    const form = event.target;
    const name = form.querySelector('#contact-name').value.trim();
    const email = form.querySelector('#contact-email').value.trim();
    const message = form.querySelector('#contact-message').value.trim();
    const feedbackElement = document.getElementById('form-feedback');

    //simple validation
    if (name === '' || email === '' || message === '') {
        feedbackElement.textContent = 'Please fill out all required fields.';
        feedbackElement.className = 'feedback-error'; //use class for styling
        return; //stop the function
    }

    //since there's no backend, we just simulate a successful submission
    feedbackElement.textContent = 'Thank you for your message! We will get back to you shortly.';
    feedbackElement.className = 'feedback-success';

    //clear the form fields after successful "submission"
    form.reset();

    //optional: Hide the feedback message after a few seconds
    setTimeout(() => {
        feedbackElement.textContent = '';
        feedbackElement.className = '';
    }, 5000); //5000 milliseconds = 5 seconds
}
*/
/**
 * dynamic product page logic
 */

/**
 * initializes a product listing page by loading products for a specific category.
 */
async function initializeProductPage() {
    const categoryId = document.body.dataset.category;
    const products = await getProducts();
    if (!products) {
        document.getElementById('category-title').textContent = 'Error: Could not load products.';
        return;
    }

    const category = products.find(p => p.category === categoryId);

    const titleElement = document.getElementById('category-title');
    const gridElement = document.getElementById('product-listing-grid');

    if (category) {
    //update the page title with the correct display name
    titleElement.textContent = category.displayName;
            //generate the product cards, filtering out "None" options
            let content = '';
            const filteredOptions = category.options.filter(option => 
                option.name.toLowerCase() !== 'none' && 
                !option.name.toLowerCase().includes('standard cables') &&
                !option.name.toLowerCase().includes('onboard wi-fi')
            );

            filteredOptions.forEach(option => {
                content += `
                    <div class="product-card">
                        <img src="${option.image}" alt="${option.name}">
                        <h3>${option.name}</h3>
                        <p>$${parseFloat(option.price).toFixed(2)}</p>
                    </div>
                `;
            });
            gridElement.innerHTML = content;

        } else {

        titleElement.textContent = 'Category Not Found';
        gridElement.innerHTML = `<p>Sorry, we could not find products for the category "${categoryId}".</p>`;
    }
}

/**
 * add to cart logic
 */

/**
 * handles the "Add to Cart" button on the builder page.
 * gathers selected components and sends them to the backend.
 * @param {Event} event - The form submission event.
 */
async function handleAddToCart(event) {
    //prevent the form from submitting in the traditional way (reloading the page)
    event.preventDefault();

    const selections = document.querySelectorAll('.component-select');
    let buildData = [];

    //loop through each dropdown to get the selected component
    selections.forEach(select => {
        const selectedOption = select.options[select.selectedIndex];
        const categoryLabel = select.previousElementSibling.textContent;

        buildData.push({
            category: categoryLabel,
            name: selectedOption.value,
            price: parseFloat(selectedOption.dataset.price)
        });
    });

    //use the Fetch API to send the data to our PHP script
    try {
        const response = await fetch('php/add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(buildData)
        });

        const result = await response.json();

        //show a confirmation to the user and redirect them to the cart page
        if (result.status === 'success') {
            alert('Build successfully added to your cart!');
            await updateCartIconCount(); 
            window.location.href = 'cart.php'; //redirect to the cart page
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Failed to add to cart:', error);
        alert('An error occurred while adding to your cart. Please try again.');
    }
}
/**
 * auto hide header on scroll logic
 */
let lastScrollTop = 0;
const header = document.querySelector('header');

window.addEventListener('scroll', function () {
    //make sure there is a header on the page to avoid errors
    if (!header) return;

    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop && currentScroll > header.offsetHeight) {
        //scrolling Down and past the header
        header.classList.add('header-hidden');
    } else {
        //scrolling Up
        header.classList.remove('header-hidden');
    }
    //for Mobile or negative scrolling
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
}, false);

function initializePasswordToggles() {
    const setupToggle = (iconId, fieldId) => {
        const icon = document.getElementById(iconId);
        const field = document.getElementById(fieldId);

        if (!icon || !field) return;

        icon.addEventListener('click', function(e) {
            e.preventDefault();
            if (field.type === "password") {
                field.type = "text";
                this.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = "password";
                this.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    };

    setupToggle('togglePassword', 'password');
    setupToggle('togglePasswordConfirm', 'password_confirm');
}
