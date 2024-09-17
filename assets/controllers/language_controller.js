import { Controller } from '@hotwired/stimulus';


export default class extends Controller {
    static targets = ['language', 'countryFilter'];

    connect() {
        // You can initialize anything here if needed
    }

    // This method will be called on language change
    changeLanguage(event) {
        const langId = event.target.value;
        this.populateCountryDataByLangId(langId);
    }

    async populateCountryDataByLangId(langId) {
        try {
            // Clear current options
            this.countryFilterTarget.innerHTML = '';

            // Fetch country data by language ID
            const response = await fetch(`/list-countries-by-lang-id/${langId}`, {
                method: 'POST',
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            let options = '';

            // Loop through the countries and create <option> elements
            data.countries.forEach(country => {
                options += `<option value="${country.id}">${country.countryName}</option>`;
            });

            // Append options to the country select element
            this.countryFilterTarget.innerHTML = options;
        } catch (error) {
            console.error('Error fetching country data:', error);
        }
    }
}
