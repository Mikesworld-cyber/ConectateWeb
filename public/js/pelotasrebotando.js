     const canvas = document.getElementById('networkCanvas');
        const ctx = canvas.getContext('2d');

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        // Nodos de la red
        const nodes = [];
        const nodeCount = 15;
        const connectionDistance = 200;

        class Node {
            constructor(x, y) {
                this.x = x;
                this.y = y;
                this.vx = (Math.random() - 0.5) * 2;
                this.vy = (Math.random() - 0.5) * 2;
                this.radius = Math.random() * 4 + 3;
                this.color = ['#00d9ff', '#0099ff', '#00ff88', '#ff00ff', '#00ffff'][Math.floor(Math.random() * 5)];
                this.pulsePhase = Math.random() * Math.PI * 2;
            }

            update() {
                this.x += this.vx;
                this.y += this.vy;

                // Rebotar en bordes
                if (this.x - this.radius < 0 || this.x + this.radius > canvas.width) {
                    this.vx = -this.vx;
                    this.x = Math.max(this.radius, Math.min(canvas.width - this.radius, this.x));
                }
                if (this.y - this.radius < 0 || this.y + this.radius > canvas.height) {
                    this.vy = -this.vy;
                    this.y = Math.max(this.radius, Math.min(canvas.height - this.radius, this.y));
                }

                this.pulsePhase += 0.05;
            }

            draw() {
                // Pulso
                const pulseSize = Math.sin(this.pulsePhase) * 2 + this.radius;
                ctx.fillStyle = this.color;
                ctx.globalAlpha = 0.3;
                ctx.beginPath();
                ctx.arc(this.x, this.y, pulseSize, 0, Math.PI * 2);
                ctx.fill();

                // Nodo principal
                ctx.globalAlpha = 1;
                ctx.fillStyle = this.color;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fill();

                // Brillo
                ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
                ctx.beginPath();
                ctx.arc(this.x - this.radius / 3, this.y - this.radius / 3, this.radius / 3, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        // Crear nodos
        for (let i = 0; i < nodeCount; i++) {
            nodes.push(new Node(
                Math.random() * canvas.width,
                Math.random() * canvas.height
            ));
        }

        // Paquetes de datos viajando
        const packets = [];

        class DataPacket {
            constructor(startNode, endNode) {
                this.startNode = startNode;
                this.endNode = endNode;
                this.progress = 0;
                this.speed = Math.random() * 0.01 + 0.005;
                this.size = Math.random() * 3 + 2;
                this.color = startNode.color;
            }

            update() {
                this.progress += this.speed;
                if (this.progress >= 1) {
                    this.progress = 0;
                    this.startNode = this.endNode;
                    this.endNode = nodes[Math.floor(Math.random() * nodes.length)];
                }
            }

            draw() {
                const x = this.startNode.x + (this.endNode.x - this.startNode.x) * this.progress;
                const y = this.startNode.y + (this.endNode.y - this.startNode.y) * this.progress;

                // Glow
                ctx.fillStyle = this.color;
                ctx.globalAlpha = 0.4;
                ctx.beginPath();
                ctx.arc(x, y, this.size * 2, 0, Math.PI * 2);
                ctx.fill();

                // Paquete
                ctx.globalAlpha = 1;
                ctx.fillStyle = this.color;
                ctx.beginPath();
                ctx.arc(x, y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        // Crear paquetes
        for (let i = 0; i < 20; i++) {
            const startNode = nodes[Math.floor(Math.random() * nodes.length)];
            const endNode = nodes[Math.floor(Math.random() * nodes.length)];
            packets.push(new DataPacket(startNode, endNode));
        }

        function drawConnections() {
            for (let i = 0; i < nodes.length; i++) {
                for (let j = i + 1; j < nodes.length; j++) {
                    const dx = nodes[i].x - nodes[j].x;
                    const dy = nodes[i].y - nodes[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < connectionDistance) {
                        const opacity = (1 - distance / connectionDistance) * 0.3;
                        ctx.strokeStyle = `rgba(0, 217, 255, ${opacity})`;
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.moveTo(nodes[i].x, nodes[i].y);
                        ctx.lineTo(nodes[j].x, nodes[j].y);
                        ctx.stroke();
                    }
                }
            }
        }

        function animate() {
            // Limpiar canvas
            ctx.fillStyle = 'rgba(15, 15, 30, 0.1)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Actualizar y dibujar nodos
            nodes.forEach(node => {
                node.update();
                node.draw();
            });

            // Dibujar conexiones
            drawConnections();

            // Actualizar y dibujar paquetes
            packets.forEach(packet => {
                packet.update();
                packet.draw();
            });

            ctx.globalAlpha = 1;
            requestAnimationFrame(animate);
        }

        animate();

        // Redimensionar canvas
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });