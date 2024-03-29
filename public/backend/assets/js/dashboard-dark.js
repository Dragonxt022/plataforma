$(function() {
  'use strict'



  var colors = {
    primary        : "#6571ff",
    secondary      : "#7987a1",
    success        : "#05a34a",
    info           : "#66d1d1",
    warning        : "#fbbc06",
    danger         : "#ff3366",
    light          : "#e9ecef",
    dark           : "#060c17",
    muted          : "#7987a1",
    gridBorder     : "rgba(77, 138, 240, .15)",
    bodyColor      : "#b8c3d9",
    cortext        : "#ffffff",
    cardBg         : "#0c1427"
  }

  var fontFamily = "'Roboto', Helvetica, sans-serif"

  var revenueChartData = [
    49.33,
    48.79,
    50.61,
    53.31,
    54.78,
    53.84,
    54.68,
    56.74,
    56.99,
    56.14,
    56.56,
    60.35,
    58.74,
    61.44,
    61.11,
    58.57,
    54.72,
    52.07,
    51.09,
    47.48,
    48.57,
    48.99,
    53.58,
    50.28,
    46.24,
    48.61,
    51.75,
    51.34,
    50.21,
    54.65,
    52.44,
    53.06,
    57.07,
    52.97,
    48.72,
    52.69,
    53.59,
    58.52,
    55.10,
    58.05,
    61.35,
    57.74,
    60.27,
    61.00,
    57.78,
    56.80,
    58.90,
    62.45,
    58.75,
    58.40,
    56.74,
    52.76,
    52.30,
    50.56,
    55.40,
    50.49,
    52.49,
    48.79,
    47.46,
    43.31,
    38.96,
    34.73,
    31.03,
    32.63,
    36.89,
    35.89,
    32.74,
    33.20,
    30.82,
    28.64,
    28.44,
    27.73,
    27.75,
    25.96,
    24.38,
    21.95,
    22.08,
    23.54,
    27.30,
    30.27,
    27.25,
    29.92,
    25.14,
    23.09,
    23.79,
    23.46,
    27.99,
    23.21,
    23.91,
    19.21,
    15.13,
    15.08,
    11.00,
    9.20,
    7.47,
    11.64,
    15.76,
    13.99,
    12.59,
    13.53,
    15.01,
    13.95,
    13.23,
    18.10,
    20.63,
    21.06,
    25.37,
    25.32,
    20.94,
    18.75,
    15.38,
    14.56,
    17.94,
    15.96,
    16.35,
    14.16,
    12.10,
    14.84,
    17.24,
    17.79,
    14.03,
    18.65,
    18.46,
    22.68,
    25.08,
    28.18,
    28.03,
    24.11,
    24.28,
    28.23,
    26.24,
    29.33,
    26.07,
    23.92,
    28.82,
    25.14,
    21.79,
    23.05,
    20.71,
    29.72,
    30.21,
    32.56,
    31.46,
    33.69,
    30.05,
    34.20,
    36.93,
    35.50,
    34.78,
    36.97
  ];

  var revenueChartCategories = [
    "Jan 01 2022", "Jan 02 2022", "Jan 03 2022", "Jan 04 2022", "Jan 05 2022", "Jan 06 2022", "Jan 07 2022", "Jan 08 2022", "Jan 09 2022", "Jan 10 2022", "Jan 11 2022", "Jan 12 2022", "Jan 13 2022", "Jan 14 2022", "Jan 15 2022", "Jan 16 2022", "Jan 17 2022", "Jan 18 2022", "Jan 19 2022", "Jan 20 2022","Jan 21 2022", "Jan 22 2022", "Jan 23 2022", "Jan 24 2022", "Jan 25 2022", "Jan 26 2022", "Jan 27 2022", "Jan 28 2022", "Jan 29 2022", "Jan 30 2022", "Jan 31 2022",
    "Fev 01 2022", "Fev 02 2022", "Fev 03 2022", "Fev 04 2022", "Fev 05 2022", "Fev 06 2022", "Fev 07 2022", "Fev 08 2022", "Fev 09 2022", "Fev 10 2022", "Fev 11 2022", "Fev 12 2022", "Fev 13 2022", "Fev 14 2022", "Fev 15 2022", "Fev 16 2022", "Fev 17 2022", "Fev 18 2022", "Fev 19 2022", "Fev 20 2022","Fev 21 2022", "Fev 22 2022", "Fev 23 2022", "Fev 24 2022", "Fev 25 2022", "Fev 26 2022", "Fev 27 2022", "Fev 28 2022",
    "Mar 01 2022", "Mar 02 2022", "Mar 03 2022", "Mar 04 2022", "Mar 05 2022", "Mar 06 2022", "Mar 07 2022", "Mar 08 2022", "Mar 09 2022", "Mar 10 2022", "Mar 11 2022", "Mar 12 2022", "Mar 13 2022", "Mar 14 2022", "Mar 15 2022", "Mar 16 2022", "Mar 17 2022", "Mar 18 2022", "Mar 19 2022", "Mar 20 2022","Mar 21 2022", "Mar 22 2022", "Mar 23 2022", "Mar 24 2022", "Mar 25 2022", "Mar 26 2022", "Mar 27 2022", "Mar 28 2022", "Mar 29 2022", "Mar 30 2022", "Mar 31 2022",
    "Abr 01 2022", "Abr 02 2022", "Abr 03 2022", "Abr 04 2022", "Abr 05 2022", "Abr 06 2022", "Abr 07 2022", "Abr 08 2022", "Abr 09 2022", "Abr 10 2022", "Abr 11 2022", "Abr 12 2022", "Abr 13 2022", "Abr 14 2022", "Abr 15 2022", "Abr 16 2022", "Abr 17 2022", "Abr 18 2022", "Abr 19 2022", "Abr 20 2022","Abr 21 2022", "Abr 22 2022", "Abr 23 2022", "Abr 24 2022", "Abr 25 2022", "Abr 26 2022", "Abr 27 2022", "Abr 28 2022", "Abr 29 2022", "Abr 30 2022",
    "Mai 01 2022", "Mai 02 2022", "Mai 03 2022", "Mai 04 2022", "Mai 05 2022", "Mai 06 2022", "Mai 07 2022", "Mai 08 2022", "Mai 09 2022", "Mai 10 2022", "Mai 11 2022", "Mai 12 2022", "Mai 13 2022", "Mai 14 2022", "Mai 15 2022", "Mai 16 2022", "Mai 17 2022", "Mai 18 2022", "Mai 19 2022", "Mai 20 2022","Mai 21 2022", "Mai 22 2022", "Mai 23 2022", "Mai 24 2022", "Mai 25 2022", "Mai 26 2022", "Mai 27 2022", "Mai 28 2022", "Mai 29 2022", "Mai 30 2022",
  ];





  // Date Picker
  if($('#dashboardDate').length) {
    flatpickr("#dashboardDate", {
      wrap: true,
      dateFormat: "d-M-Y",
      defaultDate: "today",
    });
  }
  // Date Picker - END


  // Apex Donut chart start
  if ($('#apexDonut').length) {
      $.ajax({
          url: '/admin/informacoes-inscricoes',
          method: 'GET',
          success: function(data) {

             // Verifica se os dados estão presentes e no formato esperado
            if (data && typeof data.totalProcessando === 'string' && typeof data.totalConcluido === 'string' && typeof data.totalCancelado === 'string' && typeof data.totalDescontos === 'string') {
                var totalProcessando = parseFloat(data.totalProcessando.replace(',', '.')) || 0;
                var totalConcluido = parseFloat(data.totalConcluido.replace(',', '.')) || 0;
                var totalCancelado = parseFloat(data.totalCancelado.replace(',', '.')) || 0;
                var totalDescontos = parseFloat(data.totalDescontos.replace(',', '.')) || 0;
            
                
            
            } else {
                console.error('Os dados recebidos não estão no formato esperado.');
            }

            // Formate os valores para o formato de moeda brasileira
            if (typeof totalProcessando === 'number') {
              totalProcessando = totalProcessando.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            }

            if (typeof totalConcluido === 'number') {
              totalConcluido = totalConcluido.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            }

            if (typeof totalCancelado === 'number') {
              totalCancelado = totalCancelado.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            }

            if (typeof totalDescontos === 'number') {
              totalDescontos = totalDescontos.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            }
        
            // Crie um array de objetos com os valores e rótulos correspondentes
            var seriesData = [
                { value: totalProcessando, label: 'Dados-1' },
                { value: totalConcluido, label: 'Dados-2' },
                { value: totalCancelado, label: 'Dados-3' },
                { value: totalDescontos, label: 'Dados-4' }
            ];
        
            var options = {
                chart: {
                    height: 300,
                    type: "donut",
                    foreColor: colors.cortext,
                    background: colors.cardBg,
                    toolbar: {
                        show: false
                    },
                },
                theme: {
                    mode: 'dark'
                },
                tooltip: {
                    theme: 'dark'
                },
                stroke: {
                    colors: ['rgba(0,0,0,0)']
                },
                colors: [colors.warning, colors.success, colors.danger, colors.primary],
                legend: {
                    show: true,
                    position: "top",
                    horizontalAlign: 'center',
                    fontFamily: fontFamily,
                    itemMargin: {
                        horizontal: 8,
                        vertical: 0
                    },
                },
                dataLabels: {
                    enabled: true
                },
                series: seriesData.map(function(item) {
                    return parseFloat(item.value.replace(/[^\d.-]/g, ''));
                }),
                labels: seriesData.map(function(item) {
                  return item.value;
                })
            };
        
            var chart = new ApexCharts(document.querySelector("#apexDonut"), options);
            chart.render();
        },
        error: function(xhr, status, error) {
            console.error('Erro ao obter os dados:', error);
        }
        
      });
  }
  // Apex Donut chart start


  // Gráfico de Novos Clientes - PRONTO
  if ($('#customersChart').length) {
      // Fazer a requisição AJAX para obter os dados da rota
      $.ajax({
          url: '/admin/participantes-por-dia-do-mes',
          method: 'GET',
          success: function(data) {
              // Converter os dados recebidos para o formato esperado pelo gráfico
              var seriesData = [];
              var categories = [];
              $.each(data, function(diaMes, quantidade) {
                  categories.push(diaMes);
                  seriesData.push(quantidade);
              });

              // Configurar as opções do gráfico com os dados recebidos
              var options = {
                  chart: {
                      type: "line",
                      height: 60,
                      sparkline: {
                          enabled: !0
                      }
                  },
                  series: [{
                      name: '',
                      data: seriesData
                  }],
                  xaxis: {
                      categories: categories
                  },
                  stroke: {
                      width: 2,
                      curve: "smooth"
                  },
                  markers: {
                      size: 0
                  },
                  colors: [colors.primary],
              };

              // Renderizar o gráfico com as opções configuradas
              new ApexCharts(document.querySelector("#customersChart"), options).render();
          },
          error: function(xhr, status, error) {
              console.error('Erro ao obter os dados da rota:', error);
          }
      });
  }
  // New Customers Chart - Pronto




  // Orders Chart
  if($('#ordersChart').length) {
    // Fazer solicitação AJAX para a rota
    $.ajax({
      url: '/admin/informacoes-inscritos-diarios',
      method: 'GET',
      success: function(response) {
          // Dados recebidos com sucesso
          if ($('#ordersChart').length) {
              var options2 = {
                  chart: {
                      type: "bar",
                      height: 60,
                      sparkline: {
                          enabled: !0
                      }
                  },
                  plotOptions: {
                      bar: {
                          borderRadius: 2,
                          columnWidth: "60%"
                      }
                  },
                  colors: [colors.primary],
                  series: [{
                      name: '',
                      data: response.data // Usar os dados recebidos da rota
                  }],
                  xaxis: {
                      type: 'datetime',
                      categories: response.categories // Usar as categorias recebidas da rota
                  },
              };

              // Renderizar o gráfico com os dados atualizados
              new ApexCharts(document.querySelector("#ordersChart"), options2).render();
          }
      },
      error: function(xhr, status, error) {
          // Tratar erros, se necessário
          console.error(error);
      }
    });

  }

  


  // Orders Chart - END




  // Growth Chart
  if($('#growthChart').length) {
    var options3 = {
      chart: {
        type: "line",
        height: 60,
        sparkline: {
          enabled: !0
        }
      },
      series: [{
        name: '',
        data: [41, 45, 44, 46, 52, 54, 43, 74, 82, 82, 89]
      }],
      xaxis: {
        type: 'datetime',
        categories: ["Jan 01 2022", "Jan 02 2022", "Jan 03 2022", "Jan 04 2022", "Jan 05 2022", "Jan 06 2022", "Jan 07 2022", "Jan 08 2022", "Jan 09 2022", "Jan 10 2022", "Jan 11 2022",],
      },
      stroke: {
        width: 2,
        curve: "smooth"
      },
      markers: {
        size: 0
      },
      colors: [colors.primary],
    };
    new ApexCharts(document.querySelector("#growthChart"),options3).render();
  }
  // Growth Chart - END





  // Revenue Chart
  if ($('#revenueChart').length) {
    var lineChartOptions = {
      chart: {
        type: "line",
        height: '400',
        parentHeightOffset: 0,
        foreColor: colors.bodyColor,
        background: colors.cardBg,
        toolbar: {
          show: false
        },
      },
      theme: {
        mode: 'light'
      },
      tooltip: {
        theme: 'light'
      },
      colors: [colors.primary, colors.danger, colors.warning],
      grid: {
        padding: {
          bottom: -4,
        },
        borderColor: colors.gridBorder,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      series: [
        {
          name: "Revenue",
          data: revenueChartData
        },
      ],
      xaxis: {
        type: "datetime",
        categories: revenueChartCategories,
        lines: {
          show: true
        },
        axisBorder: {
          color: colors.gridBorder,
        },
        axisTicks: {
          color: colors.gridBorder,
        },
        crosshairs: {
          stroke: {
            color: colors.secondary,
          },
        },
      },
      yaxis: {
        title: {
          text: 'Revenue ( $1000 x )',
          style:{
            size: 9,
            color: colors.muted
          }
        },
        tickAmount: 4,
        tooltip: {
          enabled: true
        },
        crosshairs: {
          stroke: {
            color: colors.secondary,
          },
        },
      },
      markers: {
        size: 0,
      },
      stroke: {
        width: 2,
        curve: "straight",
      },
    };
    var apexLineChart = new ApexCharts(document.querySelector("#revenueChart"), lineChartOptions);
    apexLineChart.render();
  }
  // Revenue Chart - END





  // Revenue Chart - RTL
  if ($('#revenueChartRTL').length) {
    var lineChartOptions = {
      chart: {
        type: "line",
        height: '400',
        parentHeightOffset: 0,
        foreColor: colors.bodyColor,
        background: colors.cardBg,
        toolbar: {
          show: false
        },
      },
      theme: {
        mode: 'light'
      },
      tooltip: {
        theme: 'light'
      },
      colors: [colors.primary, colors.danger, colors.warning],
      grid: {
        padding: {
          bottom: -4,
        },
        borderColor: colors.gridBorder,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      series: [
        {
          name: "Revenue",
          data: revenueChartData
        },
      ],
      xaxis: {
        type: "datetime",
        categories: revenueChartCategories,
        lines: {
          show: true
        },
        axisBorder: {
          color: colors.gridBorder,
        },
        axisTicks: {
          color: colors.gridBorder,
        },
        crosshairs: {
          stroke: {
            color: colors.secondary,
          },
        },
      },
      yaxis: {
        opposite: true,
        title: {
          text: 'Revenue ( $1000 x )',
          offsetX: -135,
          style:{
            size: 9,
            color: colors.muted
          }
        },
        labels: {
          align: 'left',
          offsetX: -20,
        },
        tickAmount: 4,
        tooltip: {
          enabled: true
        },
        crosshairs: {
          stroke: {
            color: colors.secondary,
          },
        },
      },
      markers: {
        size: 0,
      },
      stroke: {
        width: 2,
        curve: "straight",
      },
    };
    var apexLineChart = new ApexCharts(document.querySelector("#revenueChartRTL"), lineChartOptions);
    apexLineChart.render();
  }
  // Revenue Chart - RTL - END





  // Monthly Sales Chart - PRONTO
  if($('#monthlySalesChart').length) {
    var options = {
      chart: {
        type: 'bar',
        height: '318',
        parentHeightOffset: 0,
        foreColor: colors.bodyColor,
        background: colors.cardBg,
        toolbar: {
          show: false
        },
      },
      theme: {
        mode: 'light'
      },
      tooltip: {
        theme: 'light'
      },
      colors: [colors.primary],  
      fill: {
        opacity: .9
      } , 
      grid: {
        padding: {
          bottom: -4
        },
        borderColor: colors.gridBorder,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      series: [{
        name: 'Inscrições',
        data: []
      }],
      xaxis: {
        type: 'category',
        categories: [],
        axisBorder: {
          color: colors.gridBorder,
        },
        axisTicks: {
          color: colors.gridBorder,
        },
      },
      yaxis: {
        title: {
          text: 'Inscritos por Mês',
          style:{
            size: 9,
            color: colors.muted
          }
        },
      },
      legend: {
        show: true,
        position: "top",
        horizontalAlign: 'center',
        fontFamily: fontFamily,
        itemMargin: {
          horizontal: 8,
          vertical: 0
        },
      },
      stroke: {
        width: 0
      },
      dataLabels: {
        enabled: true,
        style: {
          fontSize: '10px',
          fontFamily: fontFamily,
        },
        offsetY: -27
      },
      plotOptions: {
        bar: {
          columnWidth: "50%",
          borderRadius: 4,
          dataLabels: {
            position: 'top',
            orientation: 'vertical',
          }
        },
      },
    }

    // Fazer a solicitação AJAX para obter os dados das vendas por mês
    $.ajax({
        url: "/admin/participantes-por-mes",
        type: "GET",
        success: function(response) {
            // Verificar se a resposta contém os dados esperados
            if (response && response.valores && response.valores.length > 0 && response.labels && response.labels.length > 0) {
                // Atualizar os dados do gráfico com os dados recebidos da resposta
                if (options.series[0] !== undefined) {
                    options.series[0].data = response.valores;


                }
                options.xaxis.categories = response.labels;
    
                // Renderizar o gráfico com os novos dados
                var apexBarChart = new ApexCharts(document.querySelector("#monthlySalesChart"), options);
                apexBarChart.render();
            } else {
                console.error("Os dados da resposta da solicitação AJAX não estão no formato esperado ou estão ausentes.");
            }
        },
    
        error: function(xhr, status, error) {
            console.error("Erro ao fazer a solicitação AJAX:", error);
        }
    });
  
    
  }
  // Monthly Sales Chart - END





  // Monthly Sales Chart - RTL
  if($('#monthlySalesChartRTL').length) {
    var options = {
      chart: {
        type: 'bar',
        height: '318',
        parentHeightOffset: 0,
        foreColor: colors.bodyColor,
        background: colors.cardBg,
        toolbar: {
          show: false
        },
      },
      theme: {
        mode: 'light'
      },
      tooltip: {
        theme: 'light'
      },
      colors: [colors.primary],  
      fill: {
        opacity: .9
      } , 
      grid: {
        padding: {
          bottom: -4
        },
        borderColor: colors.gridBorder,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      series: [{
        name: 'Vendas',
        data: [152,109,93,113,126,161,188,143,102,113,116,124]
      }],
      xaxis: {
        type: 'datetime',
        categories: ['01/01/2022','02/01/2022','03/01/2022','04/01/2022','05/01/2022','06/01/2022','07/01/2022', '08/01/2022','09/01/2022','10/01/2022', '11/01/2022', '12/01/2022'],
        axisBorder: {
          color: colors.gridBorder,
        },
        axisTicks: {
          color: colors.gridBorder,
        },
      },
      yaxis: {
        opposite: true,
        title: {
          text: 'Número de Vendas',
          offsetX: -108,
          style:{
            size: 9,
            color: colors.muted
          }
        },
        labels: {
          align: 'left',
          offsetX: -20,
        }
      },
      legend: {
        show: true,
        position: "top",
        horizontalAlign: 'center',
        fontFamily: fontFamily,
        itemMargin: {
          horizontal: 8,
          vertical: 0
        },
      },
      stroke: {
        width: 0
      },
      dataLabels: {
        enabled: true,
        style: {
          fontSize: '10px',
          fontFamily: fontFamily,
        },
        offsetY: -27
      },
      plotOptions: {
        bar: {
          columnWidth: "50%",
          borderRadius: 4,
          dataLabels: {
            position: 'top',
            orientation: 'vertical',
          }
        },
      },
    }
    
    var apexBarChart = new ApexCharts(document.querySelector("#monthlySalesChartRTL"), options);
    apexBarChart.render();
  }
  // Monthly Sales Chart - RTL - END





  // Cloud Storage Chart
  if ($('#storageChart').length) {
    var options = {
      chart: {
        height: 260,
        type: "radialBar"
      },
      series: [67],
      colors: [colors.primary],
      plotOptions: {
        radialBar: {
          hollow: {
            margin: 15,
            size: "70%"
          },
          track: {
            show: true,
            background: colors.dark,
            strokeWidth: '100%',
            opacity: 1,
            margin: 5, 
          },
          dataLabels: {
            showOn: "always",
            name: {
              offsetY: -11,
              show: true,
              color: colors.muted,
              fontSize: "13px"
            },
            value: {
              color: colors.bodyColor,
              fontSize: "30px",
              show: true
            }
          }
        }
      },
      fill: {
        opacity: 1
      },
      stroke: {
        lineCap: "round",
      },
      labels: ["Storage Used"]
    };
    
    var chart = new ApexCharts(document.querySelector("#storageChart"), options);
    chart.render();    
  }
  // Cloud Storage Chart - END


});