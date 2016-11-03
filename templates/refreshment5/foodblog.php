<?php $this->view['PAGETITLE'] = 'Erfasse deinen Kalorienverbrauch' ?>
<?php include 'header.php'?>
<div class="row">
    <div class="six columns">
        <h3>Erfasse Essen</h3>
        <form action="<?= $this->view['PAGEROOT'] ?>foodblog">
            <label>
                Nahrungsmittel:
                <input type="text" class="u-full-width" name="nahrung" id="fn">
                <div id="nahrung_autocomplete">
                    Dat
                </div>
            </label>
            <label>
                Portion
                <input type="text" class="u-full-width" name="portion" id="portion">
                <select id="amount" name="menge">
                    <option>
                        100 g
                    </option>
                </select>
            </label>
            <label>
                <input type="radio" name="mahlzeit" value="a">Frühstück.

            </label>
            <label>
                <input type="radio" name="mahlzeit" value="b">Mittag.

            </label>
            <label>
                <input type="radio" name="mahlzeit" value="c">Snack.
            </label>
            <label>
                <input type="radio" name="mahlzeit" value="d">Abend.
            </label>
            <input type="submit" />
        </form>

    </div>
    <div class="six columns">
        <div id="unknown_food">
            <h3>Neues Nahrungsmittel hinterlegen</h3>

        </div>
    </div>
</div>

<script type="text/javascript">

    $('#fn').keyup(function () {
        val = $(this).val();
        if (val.length > 3) {
            $.getJSON(WEBROOT + 'foodblog/fast/' + val, function (data) {
                out_html = parse_food(data);
                if (out_html !== null) {
                    $('#nahrung_autocomplete').css({display: 'block'});
                    $('#nahrung_autocomplete').html(out_html);
                } else
                {
                    $('#nahrung_autocomplete').css({display: 'none'});
                    $('#nahrung_autocomplete').html('');
                }
            });
        } else {
            $('#nahrung_autocomplete').css({display: 'none'});
        }
    });


    function parse_food(jayson) {
        if (typeof (jayson) != undefined)
        {
            out = '<ul>';
            $.each(jayson, function (i, item) {
                out += "<li><a class=\"food_item\" data-src=\"" + jayson[i].fid + "\" href=\"#\">" + jayson[i].name + "</a></li>";

            });
            out += "</ul>";
            return out;
        }
    }

    $('.food_item').click(function () {
        alert('tet');
    });

</script>

<?php include 'footer.php'?>