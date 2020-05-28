/**
 * Класс API
 */
class API {
    /**
     * Метод для отправки запроса к API
     * @param {string} target 
     */
    async MakeRequest(target) {
        const response = await fetch(target);
        return await response.json();
    }
    /**
     * Метод для перевода текста
     * @param string text
     */
    async TranslateUA(text) {
        let formData = new FormData();

        formData.append("text", text);
        const response = await fetch(http_root + '/api/TranslateUA', {method: "POST", body: formData});
        return await response.json();
    }
    /**
     * Метод для загрузки аватара
     * @param {File} file 
     */
    async UploadAvatar(file) {
        let formData = new FormData();

        formData.append("image", file);
        const response = await fetch(http_root + '/api/UploadAvatar', {method: "POST", body: formData});
        return await response.json();
    }
    /**
     * Метод для получения кол-ва товаров в корзине
     */
    async GetCartItemsCount() {
        return this.MakeRequest(http_root + '/api/GetCartItemsCount');
    }
    /**
     * Метод для добавления элемента в корзину
     * @param {int} itemID 
     * @param {int} sizeID
     * @param {int} colorID
     */
    async AddItemToCart(itemID, sizeID, colorID) {
        let formData = new FormData();
        formData.append('id', itemID);
        formData.append('sizeID', sizeID);
        formData.append('colorID', colorID);
        const response = await fetch(http_root + '/api/AddItemToCart', {method: "POST", body: formData});
        return await response.json();
    }
    /**
     * Метод для удаления элемента из корзины
     * @param {int} itemID 
     */
    async RemoveItemFromCart(itemID) {
        let formData = new FormData();
        formData.append('id', itemID);
        const response = await fetch(http_root + '/api/RemoveItemFromCart', {method: "POST", body: formData});
        return await response.json();
    }
    /**
     * Метод для обновления кол-ва позиций товара
     * @param {*} amount 
     * @param {*} itemID 
     */
    async UpdateAmount(amount, itemID) {
        let formData = new FormData();
        formData.append('amount', amount);
        formData.append('id', itemID);
        const response = await fetch(http_root + '/api/UpdateAmount', {method: "POST", body: formData});
        return await response.json();
    }
    /**
     * Метод для получения суммы корзины
     */
    async GetCartTotalPrice() {
        return await this.MakeRequest(http_root + '/api/GetCartTotalPrice');
    }
    /**
     * Метод для получения списка регионов
     */
    async GetRegionList() {
        return await this.MakeRequest(http_root + '/api/GetRegionList');
    }
    /**
     * Метод для получения списка городов региона
     * @param {string} region 
     */
    async GetRegionCities(region) {
        return await this.MakeRequest(http_root + '/api/GetRegionCities/' + region);
    }
    /**
     * Метод для получения отделений Новой Почты для города
     * @param {string} city 
     */
    async GetCityWarehouses(city) {
        return await this.MakeRequest(http_root + '/api/GetCityWarehouses/' + city);
    }
}