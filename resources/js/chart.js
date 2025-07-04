import Chart from 'chart.js/auto';

// Global chart instances
window.dashboardCharts = {
    systemOverview: null,
    userTrend: null
};

// Initialize charts function
function initializeDashboardCharts() {
    // Check if we're on the dashboard page
    const systemChartEl = document.getElementById('systemOverviewChart');
    const trendChartEl = document.getElementById('userTrendChart');
    
    if (!systemChartEl || !trendChartEl) {
        return false;
    }
    
    try {
        // Destroy existing charts
        if (window.dashboardCharts.systemOverview) {
            window.dashboardCharts.systemOverview.destroy();
        }
        if (window.dashboardCharts.userTrend) {
            window.dashboardCharts.userTrend.destroy();
        }
        
        // Get data for system overview chart
        const usersEl = document.querySelector('[data-users-count]');
        const rolesEl = document.querySelector('[data-roles-count]');
        const permissionsEl = document.querySelector('[data-permissions-count]');
        
        const usersCount = parseInt(usersEl?.dataset.usersCount || usersEl?.textContent || 0);
        const rolesCount = parseInt(rolesEl?.dataset.rolesCount || rolesEl?.textContent || 0);
        const permissionsCount = parseInt(permissionsEl?.dataset.permissionsCount || permissionsEl?.textContent || 0);
        
        // Create System Overview Chart
        const ctx1 = systemChartEl.getContext('2d');
        window.dashboardCharts.systemOverview = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Users', 'Roles', 'Permissions'],
                datasets: [{
                    data: [usersCount, rolesCount, permissionsCount],
                    backgroundColor: ['#2563EB', '#16A34A', '#9333EA'],
                    borderColor: ['#1D4ED8', '#15803D', '#7C3AED'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            color: getThemeColor()
                        }
                    }
                }
            }
        });
        
        // Get trend data
        const trendDataRaw = trendChartEl.dataset.trendData;
        const trendData = JSON.parse(trendDataRaw || '{"labels":[],"data":[]}');
        
        // Create User Trend Chart
        const ctx2 = trendChartEl.getContext('2d');
        window.dashboardCharts.userTrend = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: trendData.labels || [],
                datasets: [{
                    label: 'New Users',
                    data: trendData.data || [],
                    borderColor: '#2563EB',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#2563EB',
                    pointBorderColor: '#FFFFFF',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: getTickColor() },
                        grid: { color: getGridColor() }
                    },
                    x: {
                        ticks: { color: getTickColor() },
                        grid: { color: getGridColor() }
                    }
                }
            }
        });
        
        return true;
        
    } catch (error) {
        console.error('Error initializing charts:', error);
        return false;
    }
}

// Theme color functions
function getThemeColor() {
    return document.documentElement.classList.contains('dark') ? '#F4F4F5' : '#18181B';
}

function getTickColor() {
    return document.documentElement.classList.contains('dark') ? '#A1A1AA' : '#71717A';
}

function getGridColor() {
    return document.documentElement.classList.contains('dark') ? '#27272A' : '#E4E4E7';
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(initializeDashboardCharts, 100);
});

document.addEventListener('livewire:navigated', function() {
    setTimeout(initializeDashboardCharts, 300);
});

// Fallback: Try multiple times with increasing delays
function tryInitializeWithRetry() {
    const delays = [500, 1000, 2000];
    
    delays.forEach(delay => {
        setTimeout(() => {
            if (!window.dashboardCharts.systemOverview && !window.dashboardCharts.userTrend) {
                initializeDashboardCharts();
            }
        }, delay);
    });
}

// Start retry attempts after DOM is ready
document.addEventListener('DOMContentLoaded', tryInitializeWithRetry);
document.addEventListener('livewire:navigated', tryInitializeWithRetry);