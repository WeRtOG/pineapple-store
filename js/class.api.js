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
     */
    async AddItemToCart(itemID) {
        let formData = new FormData();
        formData.append('id', itemID);
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
}