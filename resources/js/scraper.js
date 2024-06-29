const puppeteer = require('puppeteer');

(async () => {
    const browser = await puppeteer.launch({ headless: true });
    const page = await browser.newPage();
    try {
        // Aumentar el tiempo de espera a 30 segundos (30000 ms)
        await page.goto('https://www.triplefacil.com/', { waitUntil: 'networkidle2', timeout: 30000 });

        // Esperar hasta que los elementos estén disponibles, con un tiempo de espera de 30 segundos (30000 ms)
        await page.waitForSelector('div.sc-fBEEOr.ticket', { timeout: 30000 });

        const sorteos = await page.evaluate(() => {
            const tickets = document.querySelectorAll('div.sc-fBEEOr.ticket');
            return Array.from(tickets).map(ticket => {
                const hora = ticket.querySelector('span.hora')?.innerText || 'N/A';
                const triple = ticket.querySelector('span.sc-jlOLRj')?.innerText || 'N/A';
                return { hora, triple };
            });
        });

        console.log(JSON.stringify(sorteos));
    } catch (error) {
        console.error("Error:", error);
    } finally {
        await browser.close();
    }
})();