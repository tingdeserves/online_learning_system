

<!-- test page-->


    <section>
      <div class="product">
        <img src="https://i.imgur.com/EHyR2nP.png" alt="The cover of Stubborn Attachments" />
        <div class="description">
          <h3>Stubborn Attachments</h3>
          <h5>$20.00</h5>
        </div>
      </div>
      <?php echo form_open(base_url().'checkout_stripe'); ?>
      <!--<form action="/myproj/checkout.php" method="POST">-->
        <button type="submit" id="checkout-button">Checkout</button>
      <!--</form>-->
      <?php echo form_close(); ?>
    </section>
