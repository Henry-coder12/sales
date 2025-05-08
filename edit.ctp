<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $sale->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $sale->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sales'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Documents'), ['controller' => 'Documents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Document'), ['controller' => 'Documents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bus Seats'), ['controller' => 'BusSeats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bus Seat'), ['controller' => 'BusSeats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Dotsales'), ['controller' => 'Dotsales', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Dotsale'), ['controller' => 'Dotsales', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Programations'), ['controller' => 'Programations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Programation'), ['controller' => 'Programations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sales form large-9 medium-8 columns content">
    <?= $this->Form->create($sale) ?>
    <fieldset>
        <legend><?= __('Edit Sale') ?></legend>
        <?php
            echo $this->Form->input('code');
            echo $this->Form->input('serie');
            echo $this->Form->input('number');
            echo $this->Form->input('price');
            echo $this->Form->input('reserved');
            echo $this->Form->input('reserved_to', ['empty' => true]);
            echo $this->Form->input('locked');
            echo $this->Form->input('reference_client');
            echo $this->Form->input('documents_id', ['options' => $documents]);
            echo $this->Form->input('client_id', ['options' => $clients, 'empty' => true]);
            echo $this->Form->input('bus_seat_id', ['options' => $busSeats]);
            echo $this->Form->input('dotsale_id', ['options' => $dotsales, 'empty' => true]);
            echo $this->Form->input('programation_id', ['options' => $programations]);
            echo $this->Form->input('agence_id_external');
            echo $this->Form->input('date_travel', ['empty' => true]);
            echo $this->Form->input('hour_travel', ['empty' => true]);
            echo $this->Form->input('ubigeo_id_origin');
            echo $this->Form->input('ubigeo_id_detine');
            echo $this->Form->input('cancel_sale');
            echo $this->Form->input('not_payment');
            echo $this->Form->input('obs');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
