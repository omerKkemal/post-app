// Dashboard charts initialization extracted from dashboard.blade.php
document.addEventListener('DOMContentLoaded', function() {
    // Wait until Chart is available (CDN may load after Vite bundle)
    function whenChartReady(cb) {
        if (window.Chart) return cb();
        const maxAttempts = 20; let attempts = 0;
        const interval = setInterval(() => {
            attempts++;
            if (window.Chart) { clearInterval(interval); cb(); }
            if (attempts >= maxAttempts) { clearInterval(interval); console.warn('Chart.js not available'); }
        }, 200);
    }

    whenChartReady(function() {
        try {
            const data = window.__DASHBOARD_DATA__ || {};

            // Category doughnut
            const categoryCanvas = document.getElementById('categoryChart');
            if (categoryCanvas && data.numberOfPostsByCategory) {
                const ctx = categoryCanvas.getContext('2d');
                const labels = data.numberOfPostsByCategory.labels || [];
                const values = data.numberOfPostsByCategory.values || [];
                const colors = generateColors(labels.length);
                new Chart(ctx, {
                    type: 'doughnut',
                    data: { labels: labels, datasets: [{ data: values, backgroundColor: colors, borderColor: 'white', borderWidth: 2, hoverOffset: 15 }] },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'right', labels: { color: '#6B7280', font: { size: 11 }, padding: 15, usePointStyle: true, pointStyle: 'circle' } },
                            tooltip: { backgroundColor: 'rgba(0,0,0,0.8)', titleColor: 'white', bodyColor: 'white', borderColor: 'rgba(255,255,255,0.1)', borderWidth: 1, cornerRadius: 8, callbacks: { label: function(context) { const label = context.label || ''; const value = context.parsed; const total = context.dataset.data.reduce((a,b)=>a+b,0); const percentage = total ? Math.round((value/total)*100) : 0; return `${label}: ${value} posts (${percentage}%)`; } } }
                        },
                        cutout: '60%',
                        animation: { animateScale: true, animateRotate: true, duration: 1000, easing: 'easeOutQuart' }
                    }
                });
            }

            // Subscriptions over time (line)
            const subscriptionCanvas = document.getElementById('subscriptionChart');
            if (subscriptionCanvas && data.subscriptionsOverTime) {
                const ctx = subscriptionCanvas.getContext('2d');
                const subscriptionData = data.subscriptionsOverTime || {};
                const labels = Object.keys(subscriptionData);
                const values = Object.values(subscriptionData);
                if (labels.length === 0) { labels.push('No data'); values.push(0); }
                new Chart(ctx, {
                    type: 'line',
                    data: { labels: labels, datasets: [{ label: 'Subscriptions', data: values, backgroundColor: 'rgba(245,158,11,0.1)', borderColor: 'rgba(245,158,11,1)', borderWidth: 3, tension: 0.1, fill: true, pointBackgroundColor: function(context){ return context.parsed.y === 0 ? 'rgba(156,163,175,0.6)' : 'rgba(245,158,11,1)'; }, pointBorderColor: '#ffffff', pointBorderWidth: 2, pointRadius: function(context){ return context.parsed.y === 0 ? 3 : 6; }, pointHoverRadius: 8 }] },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: { legend: { display: true, position: 'top', labels: { color: '#6B7280', font: { size: 12 } } }, tooltip: { backgroundColor: 'rgba(0,0,0,0.8)', titleColor: 'white', bodyColor: 'white', borderColor:'rgba(255,255,255,0.1)', borderWidth:1, cornerRadius:8, displayColors:false, callbacks: { label: function(context){ const subscriptions = context.parsed.y; const date = context.label; return subscriptions === 0 ? `No subscriptions on ${date}` : `${subscriptions} subscription${subscriptions !== 1 ? 's' : ''} on ${date}`; } } } },
                        scales: { y: { beginAtZero:true, grid:{ color:'rgba(0,0,0,0.1)' }, ticks:{ stepSize:1, color:'#6B7280' }, title:{ display:true, text:'Number of Subscriptions', color:'#6B7280' } }, x: { grid:{ color:'rgba(0,0,0,0.05)' }, ticks:{ color:'#6B7280', maxTicksLimit:10 }, title:{ display:true, text:'Date', color:'#6B7280' } } },
                        interaction: { intersect:false, mode:'index' }, animation:{ duration:1000, easing:'easeOutQuart' }
                    }
                });
            }

            // Posts over time (line)
            const timeCanvas = document.getElementById('timeChart');
            if (timeCanvas && data.postsOverTime) {
                const ctx = timeCanvas.getContext('2d');
                const postsData = data.postsOverTime || {};
                const labels = Object.keys(postsData);
                const values = Object.values(postsData);
                if (labels.length === 0) { labels.push('No data'); values.push(0); }
                new Chart(ctx, {
                    type: 'line',
                    data: { labels: labels, datasets: [{ label: 'Posts Created', data: values, backgroundColor: 'rgba(59,130,246,0.1)', borderColor: 'rgba(59,130,246,1)', borderWidth: 3, tension: 0.1, fill: true, pointBackgroundColor: function(context){ return context.parsed.y === 0 ? 'rgba(156,163,175,0.6)' : 'rgba(59,130,246,1)'; }, pointBorderColor:'#ffffff', pointBorderWidth:2, pointRadius:function(context){ return context.parsed.y === 0 ? 3 : 6; }, pointHoverRadius:8 }] },
                    options: { responsive:true, maintainAspectRatio:false, plugins:{ legend:{ display:true, position:'top', labels:{ color:'#6B7280', font:{ size:12 } } }, tooltip:{ backgroundColor:'rgba(0,0,0,0.8)', titleColor:'white', bodyColor:'white', borderColor:'rgba(255,255,255,0.1)', borderWidth:1, cornerRadius:8, displayColors:false, callbacks:{ label:function(context){ const posts = context.parsed.y; const date = context.label; return posts === 0 ? `No posts on ${date}` : `${posts} post${posts !== 1 ? 's' : ''} on ${date}`; } } } },
                        scales:{ y:{ beginAtZero:true, grid:{ color:'rgba(0,0,0,0.1)' }, ticks:{ stepSize:1, color:'#6B7280' }, title:{ display:true, text:'Number of Posts', color:'#6B7280' } }, x:{ grid:{ color:'rgba(0,0,0,0.05)' }, ticks:{ color:'#6B7280', maxTicksLimit:10 }, title:{ display:true, text:'Date', color:'#6B7280' } } }, interaction:{ intersect:false, mode:'index' }, animation:{ duration:1000, easing:'easeOutQuart' } }
                });
            }
        } catch (e) { console.error('Failed to init dashboard charts', e); }
    });

    function generateColors(count) {
        const colors = [];
        const colorPalette = ['rgba(59,130,246,0.8)','rgba(16,185,129,0.8)','rgba(245,158,11,0.8)','rgba(239,68,68,0.8)','rgba(139,92,246,0.8)','rgba(14,165,233,0.8)','rgba(20,184,166,0.8)','rgba(249,115,22,0.8)'];
        for (let i = 0; i < count; i++) colors.push(colorPalette[i % colorPalette.length]);
        return colors;
    }
});
