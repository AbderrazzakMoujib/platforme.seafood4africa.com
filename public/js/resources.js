document.addEventListener('DOMContentLoaded', function () {

    const svgEl   = document.getElementById('africaMap');
    const tooltip = document.getElementById('mapTooltip');
    const tipFlag = document.getElementById('tooltipFlag');
    const tipName = document.getElementById('tooltipName');
    const loading = document.getElementById('mapLoading');
    const cards   = document.querySelectorAll('.country-card[data-iso]');

    if (!svgEl) return;

    const ACTIVE = window.AFRICA_ACTIVE || {};

    const AFRICA_IDS = new Set([
        12, 24, 72, 108, 120, 132, 140, 148, 174, 178, 180, 204,
        231, 232, 262, 266, 270, 288, 324, 384, 404, 426, 430, 434,
        450, 454, 466, 478, 480, 504, 508, 516, 562, 566, 624, 646,
        686, 694, 706, 710, 716, 728, 729, 736, 748, 768, 788, 800,
        818, 834, 854, 894
    ]);

    const AFRICA_NAMES = {
        12:'Algeria', 24:'Angola', 72:'Botswana', 108:'Burundi', 120:'Cameroon',
        132:'Cape Verde', 140:'Central African Republic', 148:'Chad', 174:'Comoros',
        178:'Republic of the Congo', 180:'DR Congo', 204:'Benin', 231:'Ethiopia',
        232:'Eritrea', 262:'Djibouti', 266:'Gabon', 270:'Gambia', 288:'Ghana',
        324:'Guinea', 384:"Côte d'Ivoire", 404:'Kenya', 426:'Lesotho', 430:'Liberia',
        434:'Libya', 450:'Madagascar', 454:'Malawi', 466:'Mali', 478:'Mauritania',
        480:'Mauritius', 504:'Morocco', 508:'Mozambique', 516:'Namibia', 562:'Niger',
        566:'Nigeria', 624:'Guinea-Bissau', 646:'Rwanda', 686:'Senegal', 694:'Sierra Leone',
        706:'Somalia', 710:'South Africa', 716:'Zimbabwe', 728:'South Sudan',
        729:'Sudan', 736:'Sudan (old)', 748:'Eswatini', 768:'Togo', 788:'Tunisia',
        800:'Uganda', 818:'Egypt', 834:'Tanzania', 854:'Burkina Faso', 894:'Zambia'
    };

    const pathByIso = {};

    fetch('https://cdn.jsdelivr.net/npm/world-atlas@2/countries-50m.json')
        .then(function (r) { return r.json(); })
        .then(function (world) {
            var features = topojson.feature(world, world.objects.countries).features
                .filter(function (f) { return AFRICA_IDS.has(+f.id); });
            renderMap(features);
            if (loading) loading.style.display = 'none';
        })
        .catch(function () {
            if (loading) loading.innerHTML = '<span style="color:#B1BBD4;font-size:13px">Map unavailable</span>';
        });

    function renderMap(features) {
        var W = 500, H = 620, PAD = 20;

        var svg = d3.select(svgEl).attr('viewBox', '0 0 ' + W + ' ' + H);

        svg.append('rect')
            .attr('width', W).attr('height', H)
            .attr('fill', 'rgba(1, 20, 50, 0.35)').attr('rx', 14);

        var projection = d3.geoMercator()
            .fitExtent([[PAD, PAD], [W - PAD, H - PAD]], { type: 'FeatureCollection', features: features });

        var pathGen = d3.geoPath().projection(projection);

        svg.append('path')
            .datum(d3.geoGraticule()())
            .attr('d', pathGen)
            .attr('fill', 'none')
            .attr('stroke', 'rgba(1, 157, 234, 0.07)')
            .attr('stroke-width', 0.6);

        features.forEach(function (feature) {
            var numId    = +feature.id;
            var meta     = ACTIVE[numId];
            var isActive = !!meta;
            var name     = isActive ? meta.name : (AFRICA_NAMES[numId] || '');

            var path = svg.append('path')
                .datum(feature)
                .attr('d', pathGen)
                .attr('class', isActive ? 'country-path has-data' : 'country-path')
                .attr('data-iso', isActive ? meta.iso : '')
                .style('fill',         isActive ? 'rgba(1, 157, 234, 0.55)' : 'rgba(1, 157, 234, 0.08)')
                .style('stroke',       isActive ? '#019DEA'                  : 'rgba(1, 157, 234, 0.22)')
                .style('stroke-width', isActive ? '1.2'                      : '0.5')
                .style('cursor',       isActive ? 'pointer'                  : 'default')
                .style('transition',   'fill 0.22s ease, stroke 0.22s ease, filter 0.22s ease');

            path.on('mouseenter', function () {
                if (isActive) {
                    activatePath(path, true);
                    tipFlag.src = meta.flag;
                    tipFlag.style.display = '';
                    tipFlag.onerror = function () { this.style.display = 'none'; };
                    highlightCard(meta.iso, true);
                } else {
                    tipFlag.style.display = 'none';
                }
                tipName.textContent = name;
                tooltip.classList.add('visible');
            });

            path.on('mousemove', function (event) {
                var rect = svgEl.closest('.africa-map-wrapper').getBoundingClientRect();
                var x = event.clientX - rect.left + 15;
                var y = event.clientY - rect.top  - 10;
                if (x + 165 > rect.width)  x = event.clientX - rect.left - 175;
                if (y + 55  > rect.height) y = event.clientY - rect.top  - 60;
                tooltip.style.left = x + 'px';
                tooltip.style.top  = y + 'px';
            });

            path.on('mouseleave', function () {
                if (isActive) {
                    activatePath(path, false);
                    highlightCard(meta.iso, false);
                }
                tooltip.classList.remove('visible');
            });

            if (!isActive) return;

            pathByIso[meta.iso] = path;

            path.on('click', function () {
                if (meta.url && meta.url !== '#') window.location.href = meta.url;
            });
        });

        // ===== LESOTHO MANUAL MARKER =====
        var lesothoMeta = ACTIVE[426];
        if (lesothoMeta) {
            var lesothoCoords = projection([28.5, -29.5]);
            if (lesothoCoords) {

                // pulse ring (behind)
                var pulse = svg.append('circle')
                    .attr('cx', lesothoCoords[0])
                    .attr('cy', lesothoCoords[1])
                    .attr('r', 7)
                    .style('fill', 'none')
                    .style('stroke', '#019DEA')
                    .style('stroke-width', '1.5')
                    .style('pointer-events', 'none');

                pulse.append('animate')
                    .attr('attributeName', 'r')
                    .attr('values', '7;16')
                    .attr('dur', '2s')
                    .attr('repeatCount', 'indefinite');

                pulse.append('animate')
                    .attr('attributeName', 'opacity')
                    .attr('values', '0.7;0')
                    .attr('dur', '2s')
                    .attr('repeatCount', 'indefinite');

                // main dot (on top, interactive)
                var dot = svg.append('circle')
                    .attr('cx', lesothoCoords[0])
                    .attr('cy', lesothoCoords[1])
                    .attr('r', 7)
                    .style('fill', 'rgba(1, 157, 234, 0.55)')
                    .style('stroke', '#019DEA')
                    .style('stroke-width', '1.5')
                    .style('cursor', 'pointer')
                    .style('transition', 'fill 0.22s ease, stroke 0.22s ease, filter 0.22s ease');

                dot.on('mouseenter', function () {
                    dot.style('fill', '#019DEA')
                       .style('stroke', '#ffffff')
                       .style('filter', 'drop-shadow(0 0 8px rgba(1,157,234,0.65))');
                    tipFlag.src = lesothoMeta.flag;
                    tipFlag.style.display = '';
                    tipFlag.onerror = function () { this.style.display = 'none'; };
                    tipName.textContent = lesothoMeta.name;
                    tooltip.classList.add('visible');
                    highlightCard('LS', true);
                });

                dot.on('mousemove', function (event) {
                    var rect = svgEl.closest('.africa-map-wrapper').getBoundingClientRect();
                    var x = event.clientX - rect.left + 15;
                    var y = event.clientY - rect.top  - 10;
                    if (x + 165 > rect.width)  x = event.clientX - rect.left - 175;
                    if (y + 55  > rect.height) y = event.clientY - rect.top  - 60;
                    tooltip.style.left = x + 'px';
                    tooltip.style.top  = y + 'px';
                });

                dot.on('mouseleave', function () {
                    dot.style('fill', 'rgba(1, 157, 234, 0.55)')
                       .style('stroke', '#019DEA')
                       .style('filter', 'none');
                    tooltip.classList.remove('visible');
                    highlightCard('LS', false);
                });

                dot.on('click', function () {
                    if (lesothoMeta.url) window.location.href = lesothoMeta.url;
                });

                // register in pathByIso for card hover sync
                pathByIso['LS'] = {
                    style: function (prop, val) {
                        if (val === undefined) return dot.style(prop);
                        dot.style(prop, val);
                        return this;
                    }
                };
            }
        }
        // ===== END LESOTHO =====
    }

    function activatePath(path, on) {
        path
            .style('fill',         on ? '#019DEA'                  : 'rgba(1, 157, 234, 0.55)')
            .style('stroke',       on ? '#ffffff'                  : '#019DEA')
            .style('stroke-width', on ? '2'                        : '1.2')
            .style('filter',       on ? 'drop-shadow(0 0 8px rgba(1,157,234,0.65))' : 'none');
    }

    function highlightCard(iso, on) {
        var card = document.querySelector('.country-card[data-iso="' + iso + '"]');
        if (!card) return;
        card.classList.toggle('highlighted', on);
        if (on) card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    cards.forEach(function (card) {
        var iso = card.getAttribute('data-iso');
        if (!iso) return;
        card.addEventListener('mouseenter', function () {
            if (iso === 'LS') {
                var d = document.querySelector('#africaMap circle[data-ls]');
                return;
            }
            if (pathByIso[iso]) activatePath(pathByIso[iso], true);
        });
        card.addEventListener('mouseleave', function () {
            if (iso === 'LS') return;
            if (pathByIso[iso]) activatePath(pathByIso[iso], false);
        });
    });

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry, i) {
            if (entry.isIntersecting) {
                setTimeout(function () {
                    entry.target.style.opacity   = '1';
                    entry.target.style.transform = 'translateX(0)';
                }, i * 40);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.05 });

    document.querySelectorAll('.country-card').forEach(function (card) {
        card.style.opacity    = '0';
        card.style.transform  = 'translateX(-20px)';
        card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
        observer.observe(card);
    });

});