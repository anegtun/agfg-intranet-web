<?php


function wp_agfg_common_style() {
    return '
        <style>
            .agfg-clasificacion table tr th {
                background-color: #c6e15650;
                text-align: center;
            } 
            .agfg-clasificacion table tr td {
                padding: 6px !important;
                text-align: center;
            }
            .agfg-clasificacion table tr:nth-child(2n-1) td {
                background-color: #c6e15615;
            }
            .agfg-clasificacion table tr {
                vertical-align: middle;
            }
            .agfg-clasificacion table, .agfg-clasificacion table tr td, .agfg-clasificacion table tr th {
                border: 0;
            }



            .agfg-calendario .xornada {
                clear: both;
                padding-top: 1em;
            } 
            .agfg-calendario .xornada h4 {
                border-bottom: 1px solid #869643;
            }
            .agfg-xornada-proxima .dia-partido {
                margin: 1em 0;
                font-size: larger;
                font-weight: bold;
            }
            .agfg-calendario .partido,
            .agfg-xornada-proxima .partido,
            .agfg-xornada-anterior .partido {
                float: left;
                border: 1px solid #4187b450;
                border-radius: 0.5em;
                margin: 0.5em;
            }
            .agfg-calendario .partido {
                width: 250px;
                height: 130px;
            }
            .agfg-xornada-proxima .partido {
                width: 175px;
                height: 130px;
            }
            .agfg-xornada-anterior .partido {
                width: 270px;
                height: 100px;
            }
            .agfg-calendario .partido-big {
                height: 155px;
            }
            .agfg-calendario .partido table,
            .agfg-xornada-proxima .partido table,
            .agfg-xornada-anterior .partido table {
                border: 0;
            }
            .agfg-calendario .partido table th, .agfg-calendario .partido table td,
            .agfg-xornada-proxima .partido table th, .agfg-xornada-proxima .partido table td,
            .agfg-xornada-anterior .partido table th, .agfg-xornada-anterior .partido table td {
                border: 0 !important;
                padding: 0.25em !important;
                vertical-align: middle;
            }
            .agfg-calendario .partido table th,
            .agfg-xornada-proxima .partido table th,
            .agfg-xornada-anterior .partido table th {
                font-weight: bold;
                border-radius: 0.5em 0.5em 0 0;
                background-color: #4187b450;
                color: #04395E;
            } 
            .agfg-calendario .partido table tr td:nth-child(1),
            .agfg-xornada-proxima .partido table tr td:nth-child(1),
            .agfg-xornada-anterior .partido table tr td:nth-child(1) {
                width:20px;
            }
            .agfg-calendario .partido table tr td:nth-child(2) {
                width:120px;
            } 
            .agfg-calendario .partido table tr td:nth-child(3) {
                text-align: right;
                padding-right: 0.5em !important;
            }
            .agfg-calendario .partido .adiado,
            .agfg-xornada-proxima .partido .adiado,
            .agfg-xornada-anterior .partido .adiado {
                color: #c54242;
            }
        </style>';
}