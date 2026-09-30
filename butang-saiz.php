<!-- Function to change text size for accessibility -->
<script>

function changeSize(multiplier) {
    // Get current font size of the table
    var sizeEl = document.getElementById("saiz");
    var current_size = sizeEl.style.fontSize || 1;

    /* Check which button was pressed:
        reset button - value 2 sent  - return to original size
        +     button - value 1 sent  - increase text size
        -     button - value -1 sent - decrease text size
    */
    if(multiplier==2)
    {
        sizeEl.style.fontSize = "1em";
    }
    else
    {
        sizeEl.style.fontSize = ( parseFloat(current_size) + (multiplier * 0.2)) + "em";
    }
}
</script>

<!-- Buttons to change text size -->
| Change Text Size |
<input name='reSize1' type='button' value='reset'          onclick="changeSize(2)" />
<input name='reSize'  type='button' value='&nbsp;+&nbsp;'  onclick="changeSize(1)" />
<input name='reSize2' type='button' value='&nbsp;-&nbsp;'  onclick="changeSize(-1)" />
|
<button onclick="window.print()">Print</button>
