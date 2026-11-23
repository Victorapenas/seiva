<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEIVA — Recuperação de Senha</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f6f4;
            color: #1a2e22;
        }
        .container {
            max-width: 560px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid #e1e8e3;
        }
        .header {
            background: linear-gradient(135deg, #0f291b, #1b4d33);
            padding: 36px 32px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 6px 0 0;
            font-size: 13px;
            color: #93c5a8;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .content {
            padding: 36px 32px;
            line-height: 1.6;
        }
        .greeting {
            font-size: 18px;
            font-weight: 700;
            color: #0f291b;
            margin-bottom: 16px;
        }
        .text {
            font-size: 15px;
            color: #3b5042;
            margin-bottom: 24px;
        }
        .btn-wrapper {
            text-align: center;
            margin: 32px 0;
        }
        .btn {
            display: inline-block;
            background-color: #2e6b4f;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            box-shadow: 0 4px 12px rgba(46, 107, 79, 0.25);
        }
        .info-box {
            background: #edf5f0;
            border-left: 4px solid #2e6b4f;
            padding: 14px 16px;
            border-radius: 8px;
            font-size: 13px;
            color: #204e35;
            margin-bottom: 24px;
        }
        .alternative-link {
            font-size: 12px;
            color: #64748b;
            word-break: break-all;
            background: #f8faf9;
            padding: 12px;
            border-radius: 8px;
            border: 1px dashed #cbd5e1;
        }
        .footer {
            background-color: #f8faf9;
            padding: 24px 32px;
            text-align: center;
            border-top: 1px solid #e1e8e3;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SEIVA</h1>
            <p>Onde seu dinheiro cria raízes</p>
        </div>
        <div class="content">
            <div class="greeting">Olá, {{ $nomeUsuario }}!</div>
            <div class="text">
                Recebemos uma solicitação para redefinir a senha de acesso à sua conta no <strong>SEIVA</strong>.
            </div>
            
            <div class="btn-wrapper">
                <a href="{{ url('/redefinir-senha/' . $token) }}" class="btn" target="_blank">
                    Redefinir Minha Senha
                </a>
            </div>

            <div class="info-box">
                ⏱️ Este link é válido por <strong>60 minutos</strong> a partir do momento do envio. Se você não solicitou a redefinição, nenhuma ação é necessária e sua senha continuará segura.
            </div>

            <div class="text" style="font-size: 13px; margin-bottom: 8px;">
                Se o botão acima não funcionar, copie e cole o endereço abaixo no seu navegador:
            </div>
            <div class="alternative-link">
                {{ url('/redefinir-senha/' . $token) }}
            </div>
        </div>
        <div class="footer">
            <strong>Projeto Integrador — SEIVA</strong><br>
            Curso de Análise e Desenvolvimento de Sistemas • IFBA Campus Eunápolis
        </div>
    </div>
</body>
</html>
