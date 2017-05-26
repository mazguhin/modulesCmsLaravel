@extends ('template::back.nova.layouts.main')

@section ('content')

@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

@include ('template::back.nova.article.errors')

 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Настройки</div>
   </div>

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/setting">
       <table class="table table-striped">

           <thead>
               <th>Наименование</th>
               <th>Описание</th>
               <th>Значение</th>
           </thead>

           <tbody>
             @foreach ($settings as $setting)
               <tr>
                   <td>{{ $setting->title }}</td>
                   <td>{{ $setting->description }}</td>
                   <td>
                     @if ($setting->name=='frontTemplate')
                       <select class="form-control" name="{{ $setting->name }}">
                          @foreach ($frontTemplates as $template)
                            <option value="{{ $template }}"
                              @if ($template==$setting->value) selected @endif
                            >{{ $template }}</option>
                          @endforeach
                        </select>
                     @elseif ($setting->name=='backTemplate')
                       <select class="form-control" name="{{ $setting->name }}">
                          @foreach ($backTemplates as $template)
                            <option value="{{ $template }}"
                              @if ($template==$setting->value) selected @endif
                            >{{ $template }}</option>
                          @endforeach
                        </select>
                     @elseif ($setting->name=='displayErrorsBlocks')
                       <select class="form-control" name="{{ $setting->name }}">
                            <option value="1"
                              @if ('1'==$setting->value) selected @endif
                            >Да</option>
                            <option value="0"
                              @if ('1'!=$setting->value) selected @endif
                            >Нет</option>
                        </select>
                     @else
                        <input type="text" class="form-control" value="{{ $setting->value }}" name="{{ $setting->name }}" placeholder="Введите значение" required>
                     @endif
                  </td>
               </tr>
              @endforeach
           </tbody>
       </table>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Сохранить</button>
      </form>
   </div>
 </div>
@stop
