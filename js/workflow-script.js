document.addEventListener('DOMContentLoaded', function(){ // on dom ready

    var cy = cytoscape({
        container: document.querySelector('#cy'),
        minZoom: 0.99,
        maxZoom: 0.991,
        boxSelectionEnabled: false,
        autounselectify: true,

        style: cytoscape.stylesheet()
            .selector('node')
            .css({
                'shape': 'data(faveShape)',
                'width': 'mapData(weight, 0, 0, 0, 100)',
                "height": 'mapData(height, 0, 0, 0, 0)',
                'content': 'data(name)',
                'text-valign': 'center',
                'text-outline-width': 0.2,
                'text-outline-color': 'black',
                'background-color': 'data(faveColor)',
                'color': 'black',
                'font-size': '12px'
            })
            .selector('node.hidden')
            .css({
                'shape': 'data(faveShape)',
                'width': 'mapData(5, 5, 5, 5, 7)',
                "height": 'mapData(5, 5, 5, 5, 7)',
                'content': 'data(name)',
                'text-valign': 'center',
                'text-outline-width': 0.2,
                'text-outline-color': 'black',
                'background-color': 'black',
                'color': 'black',
                'font-size': '12px'
            })
            .selector(':selected')
            .css({
                'border-width': 1.5,
                'border-color': '#333'
            })
            .selector('edge')
            .css({
                'width': 'mapData(strength, 100, 100, 1.5, 1)',
                'target-arrow-shape': 'triangle',
                'source-arrow-shape': 'circle',
                'line-color': 'data(faveColor)',
                'source-arrow-color': 'data(faveColor)',
                'target-arrow-color': 'data(faveColor)'
            })
            .selector('edge.initial-sharped')
            .css({
                'width': 'mapData(strength, 100, 100, 1.5, 1)',
                'target-arrow-shape': 'none',
                'source-arrow-shape': 'circle',
                'line-color': 'data(faveColor)',
                'source-arrow-color': 'data(faveColor)',
                'target-arrow-color': 'data(faveColor)'
            })
            .selector('edge.sharped')
            .css({
                'width': 'mapData(strength, 100, 100, 1.5, 1)',
                'target-arrow-shape': 'none',
                'source-arrow-shape': 'none',
                'line-color': 'data(faveColor)',
                'source-arrow-color': 'data(faveColor)',
                'target-arrow-color': 'data(faveColor)'
            })
            .selector('edge.final-sharped')
            .css({
                'width': 'mapData(strength, 100, 100, 1.5, 1)',
                'target-arrow-shape': 'triangle',
                'source-arrow-shape': 'none',
                'line-color': 'data(faveColor)',
                'source-arrow-color': 'data(faveColor)',
                'target-arrow-color': 'data(faveColor)'
            }),
        elements: {
            nodes: [
                {data: {id: '1', name: "Nueva Solicitud", weight: 50, faveColor: '#FAAC58', faveShape: 'ellipse'}},
                {data: {id: '5', name: 'Habilitar proyecto', weight: 85, faveColor: '#FACC2E', faveShape: 'roundrectangle'}},
                {data: {id: '6', name: 'Es trabajo de campo?', weight: 60, faveColor: '#2ECCFA', faveShape: 'hexagon'}},
                {data: {id: '7', name: 'Elaborar alcance', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                {data: {id: '8', name: 'Revisar alcance', weight: 75, faveColor: '#FACC2E', faveShape: 'roundrectangle'}},
                {data: {id: '9', name: 'Alcance aprobado?', weight: 60, faveColor: '#FACC2E', faveShape: 'hexagon'}},
                {data: {id: '10', name: 'Determinar costos', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                {data: {id: '11', name: 'Registrar muestra', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                {data: {id: '12', name: 'Determinar ensayos', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                {data: {id: '13', name: 'Estimar tiempos', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                {data: {id: '14', name: 'Costo>10000?', weight: 100, faveColor: '#2ECCFA', faveShape: 'hexagon'}},
                {data: {id: '15', name: 'Nota de aceptacion', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                {data: {id: '16', name: 'Compromiso de pago', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                {data: {id: '17', name: 'Cobrar anticipo', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                {data: {id: '18', name: 'Iniciar trabajo', weight: 75, faveColor: '#2EFE9A', faveShape: 'roundrectangle'}},
                {data: {id: '19', name: 'Cargar resultados', weight: 75, faveColor: '#CC2EFA', faveShape: 'roundrectangle'}},
                {data: {id: '20', name: 'Revisar resultados', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                {data: {id: '21', name: 'Subir Informe', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                {data: {id: '22', name: 'Revisar Informe', weight: 75, faveColor: '#FACC2E', faveShape: 'roundrectangle'}},
                {data: {id: '23', name: 'Informe Aprobado?', weight: 60, faveColor: '#FACC2E', faveShape: 'hexagon'}},
                {data: {id: '24', name: 'Cobrar saldo', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                {data: {id: '25', name: 'Entregar Informe Final', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                {data: {id: '26', name: 'Proyecto terminado', weight: 50, faveColor: '#FAAC58', faveShape: 'ellipse'}},
                {data: {id: '27', name: '', weight: 50, faveColor: '#FAAC58', faveShape: 'ellipse'}, classes: 'hidden'},
                {data: {id: '28', name: '', weight: 50, faveColor: '#FAAC58', faveShape: 'ellipse'}, classes: 'hidden'},
                {data: {id: '29', name: '', weight: 50, faveColor: '#FAAC58', faveShape: 'ellipse'}, classes: 'hidden'},
                {data: {id: '30', name: '', weight: 50, faveColor: '#FAAC58', faveShape: 'ellipse'}, classes: 'hidden'}
            ],
            edges: [
                {data: {source: '1', target: '5', faveColor: '#033', strength: 30}},
                {data: {source: '1', target: '6', faveColor: '#033', strength: 30}},
                {data: {source: '6', target: '7', faveColor: '#033', strength: 30}},
                {data: {source: '7', target: '8', faveColor: '#033', strength: 30}},
                {data: {source: '8', target: '9', faveColor: '#033', strength: 30}},
                {data: {source: '6', target: '11', faveColor: '#033', strength: 30}},
                {data: {source: '9', target: '10', faveColor: '#033', strength: 30}},
                {data: {source: '11', target: '12', faveColor: '#033', strength: 30}},
                {data: {source: '12', target: '13', faveColor: '#033', strength: 30}},
                {data: {source: '13', target: '30', faveColor: '#033', strength: 30}, classes: 'initial-sharped'},
                {data: {source: '10', target: '14', faveColor: '#033', strength: 30}},
                {data: {source: '14', target: '15', faveColor: '#033', strength: 30}},
                {data: {source: '14', target: '16', faveColor: '#033', strength: 30}},
                {data: {source: '15', target: '17', faveColor: '#033', strength: 30}},
                {data: {source: '16', target: '17', faveColor: '#033', strength: 30}},
                {data: {source: '28', target: '17', faveColor: '#033', strength: 30}, classes: 'final-sharped'},
                {data: {source: '17', target: '18', faveColor: '#033', strength: 30}},
                {data: {source: '18', target: '19', faveColor: '#033', strength: 30}},
                {data: {source: '29', target: '20', faveColor: '#033', strength: 30}, classes: 'final-sharped'},
                {data: {source: '20', target: '21', faveColor: '#033', strength: 30}},
                {data: {source: '21', target: '22', faveColor: '#033', strength: 30}},
                {data: {source: '22', target: '23', faveColor: '#033', strength: 30}},
                {data: {source: '23', target: '24', faveColor: '#033', strength: 30}},
                {data: {source: '24', target: '25', faveColor: '#033', strength: 30}},
                {data: {source: '25', target: '26', faveColor: '#033', strength: 30}},
                {data: {source: '5', target: '27', faveColor: '#033', strength: 30}, classes: 'initial-sharped'},
                {data: {source: '27', target: '28', faveColor: '#033', strength: 30}, classes: 'sharped'},
                {data: {source: '19', target: '29', faveColor: '#033', strength: 30}, classes: 'initial-sharped'},
                {data: {source: '30', target: '10', faveColor: '#033', strength: 30}, classes: 'final-sharped'}

            ]
        },
        layout: {
            name: 'grid',
            padding: 10
        },
        ready: function() {
            window.cy = this;

            cy.$('#30').position({
                x: 450,
                y: 270
            });

            cy.$('#29').position({
                x: 800,
                y: 550
            });

            cy.$('#27').position({
                x: 5,
                y: 40
            });

            cy.$('#28').position({
                x: 5,
                y: 500
            });

            cy.$('#1').position({
                x: 450,
                y: 40
            });

            cy.$('#5').position({
                x: 80,
                y: 40
            });

            cy.$('#6').position({
                x: 450,
                y: 110
            });

            cy.$('#7').position({
                x: 250,
                y: 110
            });

            cy.$('#8').position({
                x: 80,
                y: 110
            });

            cy.$('#9').position({
                x: 80,
                y: 320
            });

            cy.$('#10').position({
                x: 450,
                y: 320
            });

            cy.$('#11').position({
                x: 270,
                y: 170
            });

            cy.$('#12').position({
                x: 270,
                y: 220
            });

            cy.$('#13').position({
                x: 270,
                y: 270
            });

            cy.$('#14').position({
                x: 450,
                y: 380
            });

            cy.$('#15').position({
                x: 520,
                y: 440
            });

            cy.$('#16').position({
                x: 380,
                y: 440
            });

            cy.$('#17').position({
                x: 450,
                y: 500
            });

            cy.$('#18').position({
                x: 650,
                y: 500
            });

            cy.$('#19').position({
                x: 800,
                y: 500
            });

            cy.$('#20').position({
                x: 270,
                y: 550
            });

            cy.$('#21').position({
                x: 270,
                y: 600
            });

            cy.$('#22').position({
                x: 65,
                y: 600
            });

            cy.$('#23').position({
                x: 65,
                y: 650
            });

            cy.$('#24').position({
                x: 450,
                y: 650
            });

            cy.$('#25').position({
                x: 450,
                y: 700
            });

            cy.$('#26').position({
                x: 450,
                y: 750
            });

            //contenido de los globos de los nodos

            cy.$('#1').qtip({
                content: '111',
                style: {
                    classes: 'qtip-bootstrap',
                    tip: {
                        width: 16,
                        height: 8
                    }
                }
            });

            cy.$('#2').qtip({
                content: '222',
                style: {
                    classes: 'qtip-bootstrap',
                    tip: {
                        width: 16,
                        height: 8
                    }
                }
            });

            cy.$('#3').qtip({
                content: '333',
                style: {
                    classes: 'qtip-bootstrap',
                    tip: {
                        width: 16,
                        height: 8
                    }
                }
            });

            cy.$('#4').qtip({
                content: '444',
                style: {
                    classes: 'qtip-bootstrap',
                    tip: {
                        width: 16,
                        height: 8
                    }
                }
            });

            cy.$('#5').qtip({
                content: '555',
                style: {
                    classes: 'qtip-bootstrap',
                    tip: {
                        width: 16,
                        height: 8
                    }
                }
            });

            cy.$('#7').qtip({
                content: '777',
                style: {
                    classes: 'qtip-bootstrap',
                    tip: {
                        width: 16,
                        height: 8
                    }
                }
            });
            // giddy up
        }
    });

    cy.on('tap', 'node', function(e){
        var node = e.cyTarget;
        var neighborhood = node.neighborhood().add(node);

        cy.elements().addClass('faded');
        neighborhood.removeClass('faded');
    });

    cy.on('tap', function(e){
        if( e.cyTarget === cy ){
            cy.elements().removeClass('faded');
        }
    });

});