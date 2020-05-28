<section class="order-page-wrapper">
    <form method="POST" class="order-page anix" data-fx="zoom">
        <h1 data-translate="content">Оформление заказа</h1>
        <select required id="region">
            <option data-translate="content" disabled selected>Выберите область</option>
        </select>
        <select required name="city" id="city">
            <option data-translate="content" disabled selected>Выберите город</option>
        </select>
        <select required name="warehouse" id="warehouse">
            <option data-translate="content" disabled selected>Выберите отделение Новой Почты</option>
        </select>
        <h3><span data-translate="content">Всего</span> <?=number_format($data['TotalPrice'], 2, ',', ' ')?> ₴</h3>
        <input data-translate="value" type="submit" value="Оформить" disabled>
    </section>
</section>