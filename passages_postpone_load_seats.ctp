<label class="control-label" for="bus_seat_id_postpone">ASIENTO BLOQUEADO</label>
<select name="bus_seat_id_postpone" class="form-control" id="bus_seat_id_postpone">
    <?php 
    foreach ($lista_seats as $value) {        
        echo '<option value="'.$value->bus_seat->id.'"  data-sale-id="'.$value->id.'">'.$value->bus_seat->name_seat.' </option>';
    }
     ?>
</select>