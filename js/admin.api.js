/**
 * Класс API админки
 */
class AdminAPI {
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
     * Метод для загрузки горизонтального фото
     * @param {int} id ID товара
     * @param {File} file Файл
     */
    async UploadHorizontalPhoto(id, file) {
        let formData = new FormData();

        formData.append("image", file);
        formData.append("id", id);
        
        const response = await fetch(http_root + '/api/UploadHorizontalPhoto', {method: "POST", body: formData});
        return await response.json();
    }
    /**
     * Метод для удаления фото товара
     * @param {int} productID 
     * @param {string} filename 
     */
    async DeleteProductPhoto(productID, filename) {
        let formData = new FormData();

        formData.append("id", productID);
        formData.append("filename", filename);
        
        const response = await fetch(http_root + '/api/DeleteProductPhoto', {method: "POST", body: formData});
        return await response.json();
    }
    /**
     * Метод для загрузки фотографии товара
     * @param {int} id ID товара
     * @param {File} file Файл
     */
    async UploadProductPhoto(id, file) {
        let formData = new FormData();

        formData.append("image", file);
        formData.append("id", id);
        
        const response = await fetch(http_root + '/api/UploadProductPhoto', {method: "POST", body: formData});
        return await response.json();
    }
}