<section class="order-page-wrapper">
    <form method="POST" class="order-page anix" data-fx="zoom">
        <h1>Оформление заказа</h1>
        <select required id="region">
            <option disabled selected>Выберите область</option>
        </select>
        <select required name="city" id="city">
            <option disabled selected>Выберите город</option>
        </select>
        <select required name="warehouse" id="warehouse">
            <option disabled selected>Выберите отделение Новой Почты</option>
        </select>
        <h3>Всего: <?=number_format($data['TotalPrice'], 2, ',', ' ')?> ₴</h3>
        <input type="submit" value="Оформить" disabled>
    </section>
</section>