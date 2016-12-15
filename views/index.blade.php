<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trans('translation::manager.title') }}</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    @include('translation::javascript')
    @include('translation::style')
</head>
<body>

    <div class="container-fluid" ng-app="trans" ng-controller="Translations">

        <h1>{{ trans('translation::manager.title') }}</h1>
        <p>
            {{ trans('translation::manager.help') }}
        </p>

        <div ng-if="message" class="alert alert-[[ message.type ]]" role="alert">
            [[ message.text ]]
        </div>
        
        <div class="row">
            <div class="col-md-2 text">
                <h3>Category</h3>
            </div>
            <div class="col-md-2 text">
                <h3>View Locale</h3>
            </div>
            <div class="col-md-2 text">
                <h3>Edit Locale</h3>
            </div>
            <div class="col-md-5">
                <div class="col-md-9">
                    <h3>Translations (changes save on tab)</h3>
                </div>

                <div class="col-md-3" style="position: absolute; bottom: 5px; right: 0;">
                    <button class="btn btn-info form-control" ng-disabled="isDisabled" ng-click="translateAll()">
                        {{ trans('translation::manager.google') }}
                    </button>
                </div>                
            </div>
            <div class="col-md-1">
                
            </div>
        </div>
        

        <div class="row" style="margin-bottom:10px">

            <div class="col-md-2">
                <select ng-model="currentGroup" ng-change="clear()" class="form-control">
                    <option ng-repeat="group in groups">[[ group ]]</option>
                </select>
            </div>

            <div class="col-md-2">
                <select ng-model="currentLocale" ng-change="clear()" class="form-control">
                    <option ng-repeat="locale in locales">[[ locale ]]</option>
                </select>
            </div>


            <div class="col-md-2">
                <select ng-model="currentEditable" ng-change="clear()" class="form-control">
                    <option ng-repeat="locale in locales">[[ locale ]]</option>
                </select>
                <!--<input ng-change="clear()" class="form-control" maxlength="2" type="text" ng-model="currentEditable" placeholder="{{ trans('translation::manager.locale_placeholder') }}" />-->
            </div>
            
            <div class="col-md-5">
                <div class="progress" style="height:34px;">
                    <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: [[ (translateResult.skip / translateResult.total) * 100 ]]%"></div>
                    <div class="progress-bar progress-bar-success progress-bar-striped" style="width: [[ (translateResult.success / translateResult.total) * 100 ]]%"></div>
                    <div class="progress-bar progress-bar-danger progress-bar-striped" style="width: [[ (translateResult.errors / translateResult.total) * 100 ]]%"></div>
                    <div class="progress-bar progress-bar-info progress-bar-striped" style="width: [[ (translateResult.loading / translateResult.total) * 100 ]]%"></div>
                </div>
            </div>

            <div class="col-md-1">
                <button class="btn btn-primary form-control" ng-model="button" ng-click="fetch()">
                    {{ trans('translation::manager.button') }}
                </button>
            </div>
        </div>

        <div class="row" ng-if="items.length > 0">
            
        </div>
        

        

        <div class="row datarow" ng-repeat="item in items">
            <div class="col-md-2 text">
                [[ item.name ]]
                <span ng-if="item.check == true" class="label label-warning">Unsaved!</span>
            </div>
            <div class="col-md-2 text">
                [[ item.value ]]
            </div>
            <div class="col-md-2 text">
                [[ item.hardTranslate ]]
            </div>
            <div class="col-md-5">
                <textarea class="form-control" ng-blur="store($index)" ng-model="item.translation" onfocus="jQuery(this).closest('.row').addClass('bg-success');" onblur="jQuery(this).closest('.row').removeClass('bg-success');"></textarea>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger" ng-click="delete($index)">
                    {{ trans('translation::manager.delete') }}
                </button>
            </div>
        </div>
    </div>

</body>
</html>