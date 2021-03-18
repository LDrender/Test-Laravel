@extends('layout')

@section('content')

    @include('sectionMapping.nav')
    @include('sectionMapping.editor')
    @include('sectionMapping.displayFilter')
    @include('sectionMapping.map')
    @include('sectionMapping.rightClickMenu')
    @include('sectionMapping.formList')

    <section id="dataList">
        <datalist id="listRaccordement">
            <option value="FSND_1">
            <option value="FSND_2-">
            <option value="FSND_3">
            <option value="FSND_4">
            <option value="FSND_5">
            <option value="DOCTYPE_1">
            <option value="DOCTYPE_2">
        </datalist>
    </section>

@endsection