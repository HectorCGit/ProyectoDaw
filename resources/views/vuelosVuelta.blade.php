<div>
    <div class="formu">

        @if($vuelta!="sin vuelta")
            @if(!$vuelta->isEmpty())
                <h1>Vuelos de vuelta</h1>
                @foreach ($vuelta as $v)
                    <div id="divGeneral">
                        <div class="divGen">
                            @if(($v->num_seats - $v->num_passengers)>=$billetes )
                                <table class="tablaFormu">
                                    <tr>
                                        <td><h5>{{$v->company}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td>Ciudad de orígen: {{ $v->origin}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ciudad de destino: {{ $v->destination}}</td>
                                    </tr>
                                    <tr>
                                        <td>Asientos
                                            disponibles: {{ ($v->num_seats - $v->num_passengers) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha y hora: {{ $v->departing}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Precio</label>
                                            <select name="precioVuelta" id="precioVuelta">
                                                <option value="{{$v->economic_price}}">
                                                    Económico: {{$v->economic_price}}</option>
                                                <option value="{{$v->business_price}}">
                                                    Business: {{$v->business_price}}</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            @else
                                <h2>NO HAY VUELOS DE VUELTA DISPONIBLES CON ASIENTOS DISPONIBLES EN ESTA FECHA.
                                    PRUEBE CON OTRA FECHA </h2>
                            @endif
                        </div>
                        <div class="w-30 h-50 p-3">
                            @auth
                                <form>
                                    <input type="hidden" name="company" value="{{$v->company}}">
                                    <input type="hidden" name="origin" value="{{$v->origin}}">
                                    <input type="hidden" name="destination" value="{{$v->destination}}">
                                    <input type="submit" value="Agregar">
                                </form>
                            @else
                                <button><a href="{{route('login')}}"
                                           style="text-decoration: none; color: white"> Agregar </a></button>
                            @endauth
                        </div>
                    </div>
                @endforeach
            @else
                <h2>NO HAY VUELOS DE VUELTA DISPONIBLES EN ESTA FECHA. PRUEBE CON OTRA FECHA </h2>
            @endif
        @endif

    </div>
</div>
