<h4 id="section-title" class="dashboard">Resumen</h4>

<div id="graphExample1"  class="dashboardGraphLarge"></div>

<style>
    
    .dashboardGraphLarge {
        width: 100%;
        height: 330px;
    }

    
</style>

<script>

    $(document).ready(function() {

         var chartExample1 = new Highcharts.Chart({
            chart: {
                renderTo: 'graphExample1'
                
            },
            title: {
                text: 'Usuarios por Mes'
            },
             xAxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                    'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            series: [{
                name: 'Activos',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Registrados',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });

     })
     
</script>