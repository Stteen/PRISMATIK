<div class="w-100" wire:ignore>
    <div>
    <select id="{{$select2_id}}" class='form-select sel2 form-control' wire:model="{{$model}}">

    </select>
    </div>
    <script>
        $('#{{$select2_id}}').select2(
            {
                @if($attachToModal!='')
                dropdownParent: $('#{{ $attachToModal }}'),
                @endif
                minimumInputLength: 4,
                ajax: {
                    delay: 250,
                    url: '/select2',
                    dataType: 'json',
                    type: 'POST',
                    data: function (params) {
                        var query = {
                            q: params.term,
                            @if($restrictors!='')
                            @foreach($restrictors as $key=>$value)
                            {{$key}}: @this.get('{{$value}}'),
                            @endforeach

                            @endif



                            action: '{{$action}}',
                            _token: '{{csrf_token()}}'
                        }
                        return query;
                    }
                }
            }
        );
        $('#{{$select2_id}}').on('change', function(e){
           let data = $('#{{$select2_id}}').select2('data');
           @this.set('{{$model}}',data[0].id);
           @if($method != "")
            @this.call('{{$method}}');
           @endif
        });
        @if($default !="")
        var {{$select2_id}}Select = $('#{{$select2_id}}');
        $.ajax({
            type: 'POST',
            url: '/select2',
            data: {
                            id: '{{$default}}',
                            action: '{{$action}}',
                            _token: '{{csrf_token()}}'
                        }
        }).then(function (data) {
        // create the option and append to Select2
        var option = new Option(data.results[0].text, data.results[0].id, true, true);
        {{$select2_id}}Select.append(option).trigger('change');
     // manually trigger the `select2:select` event
     {{$select2_id}}Select.trigger({
        type: 'select2:select',
        params: {
            data: data
        }
    });
});
        @endif
    </script>

</div>