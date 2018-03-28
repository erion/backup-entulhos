unit UxClasses;

interface

uses ExtCtrls, Forms, SysUtils;

type

  TPeca = class
    private
      pCor:string;      //cor da peca
      pX,pY:integer;  //posicao no tabuleiro
      pImagem:TImage; //imagem da peca
      pNome:string;   //nome da peca
      pCodigo:integer;//identificador
    public
      procedure SetCor(cor:string);
      procedure SetPosicao(x,y:integer);
      procedure SetNome(nome:string);
      procedure SetCodigo(codigo:integer);
      function GetCor():string;
      function GetPosicao():string;// retorno = xy
      function GetNome():string;
      function GetCodigo():string;
  end;

  TPeao = class(TPeca)
    private
    public
      constructor Create;
  end;

  TTorre = class(TPeca)
    private
    public
  end;

  TCavalo = class(TPeca)
    private
    public
  end;

  TBispo = class(TPeca)
    private
    public
  end;

  TRainha = class(TPeca)
    private
    public
  end;

  TRei = class(TPeca)
    private
    public
  end;

implementation  

{ TPeao }

constructor TPeao.Create;
begin
  pImagem := TImage.Create(nil);
  pImagem.Visible := True;
  pImagem.Picture.LoadFromFile('peao_branco.bmp');
  pImagem.Parent := Application.MainForm;
  pImagem.Transparent := True;
  pCodigo := 0;
  pNome := 'Peao';
  pImagem.Top := 226;
  pImagem.Left := 128;
end;

{ TPeca }

function TPeca.GetCodigo: string;
begin
  result := IntToStr(pCodigo);
end;

function TPeca.GetCor: string;
begin
  result := pCor;
end;

function TPeca.GetNome: string;
begin
  result := pNome;
end;

function TPeca.GetPosicao: string;
begin
  Result := IntToStr(pX)+IntToStr(pY);
end;

procedure TPeca.SetCodigo(codigo: integer);
begin
  pCodigo := codigo
end;

procedure TPeca.SetCor(cor: string);
begin
  pCor := cor;
end;

procedure TPeca.SetNome(nome: string);
begin
  pNome := nome;
end;

procedure TPeca.SetPosicao(x, y: integer);
begin
  pX := x;
  pY := y;
end;

end.
