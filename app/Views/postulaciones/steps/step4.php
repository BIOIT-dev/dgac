<section>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_aegreso">Año de Egreso <code>*</code></label>
                <select name="post_aegreso" id="post_aegreso" class="form-control">
                    <?php for($i = date("Y") - 40; $i <= date("Y"); $i++){ ?>
                        <option value="<?php echo $i ?>" id="peri_anio<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_colegio">Nombre Liceo/Colegio</label>
                <input name="post_colegio" id="post_colegio" type="text" class="form-control" onkeypress="return check(event)"> </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_testablecimiento">Tipo de establecimiento <code>*</code></label>
                <select name="post_testablecimiento" id="post_testablecimiento" class="form-control">
                    <option value="0">Particular Pagado</option>
                    <option value="1">Particular Subvencionado</option>
                    <option value="2">Municipal</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_tcolegio">Colegio <code>*</code></label>
                <select name="post_tcolegio" id="post_tcolegio" class="form-control">
                    <option value="0">Científico Humanista</option>
                    <option value="1">Técnico Profesional</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_tprocedencia">Procedencia Académica</label>
                <select name="post_tprocedencia" id="post_tprocedencia" class="form-control">
                    <option value="0">Universidad</option>
                    <option value="1">Instituto de formación técnica</option>
                    <option value="2">Escuelas matrices FFAA o Carabineros</option>
                    <option value="3">No aplica</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_titulado">Si es titulado</label>
                <select name="post_titulado" id="post_titulado" class="form-control">
                    <option value="0">No soy titulado</option>
                    <option value="1">Técnico profesional</option>
                    <option value="2">Profesional</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_eregion">Si es de región ¿dónde vivirá?</label>
                <select name="post_eregion" id="post_eregion" class="form-control">
                    <option value="0">No soy de región</option>
                    <option value="1">En casa de familiares o amigos de la familia</option>
                    <option value="2">En residencial o pensión</option>
                    <option value="3">Arrendando una pieza</option>
                    <option value="4">Arrendando una casa o depto. con amigos o compañeros</option>
                    <option value="5">Arrendando una casa o departamento solo</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_ecivil">Estado Civil</label>
                <select name="post_ecivil" id="post_ecivil" class="form-control">
                    <option value="0">Soltero</option>
                    <option value="1">Casado</option>
                    <option value="2">Divorciado</option>
                    <option value="3">Viudo</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="post_thijos">¿Tienes hijos?</label>
                <select name="post_thijos" id="post_thijos" class="form-control" onchange="mostrarTienesHijos()">
                    <option value="0">No tengo hijos</option>
                    <option value="1">Sí tengo hijos</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" hidden id="div_post_canthijos">
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_canthijos">¿Cuántos?</label>
                <select name="post_canthijos" id="post_canthijos" class="form-control">
                    <?php for($i=0; $i < 11; $i++){ ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_vhijos">¿Viven contigo?</label>
                <select name="post_vhijos" id="post_vhijos" class="form-control">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="post_idiomas">¿Qué idiomas hablas?</label>
                <select name="post_idiomas" id="post_idiomas" class="form-control" multiple>
                    <option value="Español">Español</option>
                    <option value="Mapudungún">Mapudungún</option>
                    <option value="Aymara">Aymara</option>
                    <option value="Quechua">Quechua</option>
                    <option value="Rapa Nui">Rapa Nui</option>
                    <option value="Inglés">Inglés</option>
                    <option value="Francés">Francés</option>
                    <option value="Alemán">Alemán</option>
                    <option value="Portugués">Portugués</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_ppueblo">¿Pertenece a algún pueblo originario?</label>
                <select name="post_ppueblo" id="post_ppueblo" class="form-control" onchange="mostrarPuebloOriginario()">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>
        </div>
        <div class="col-md-6" hidden id="div_post_ppueblo">
            <div class="form-group">
                <label for="post_opueblo">¿Cuál?</label>
                <select name="post_opueblo" id="post_opueblo" class="form-control">
                    <option value="1">Aymara</option>
                    <option value="2">Atacameño</option>
                    <option value="3">Colla</option>
                    <option value="4">Duaguita</option>
                    <option value="5">Mapuche</option>
                    <option value="6">Rapa Nui</option>
                    <option value="7">Otro</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_publicidad">¿Cómo conociste la oferta académica de la Escuela Técnica Aeronáutica?</label>
                <select name="post_publicidad" id="post_publicidad" class="form-control">
                    <option value="m">Charla en tu colegio</option>
                    <option value="f">Sitio web de la escuela</option>
                    <option value="f">Visita a la escuela</option>
                    <option value="f">Ferias vocacionales</option>
                    <option value="f">Facebook</option>
                    <option value="f">Twitter</option>
                    <option value="f">Instagram</option>
                    <option value="f">Amigos o familiares externos a la DGAC</option>
                    <option value="f">Amigos o familiares que trabajan en la DGAC</option>
                    <option value="f">Publicidad en diarios</option>
                    <option value="f">Publicidad en metro</option>
                    <option value="f">Publicidad en radio</option>
                    <option value="f">Publicidad en televisión</option>
                    <option value="f">Otro</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="post_mefu">A partir de tu respuesta anterior, ¿qué medio/fuente influyó más en tu decisión de postular a la Escuela Técnica Aeronáutica?</label>
                <input name="post_mefu" id="post_mefu" type="text" class="form-control" onkeypress="return check(event)"> </div>
            </div>
        </div>
    </div>
</section>