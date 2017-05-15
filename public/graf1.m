function[] = graf1(imagePath, Radius, Period, RefrIndex)

tic

epsilon = 4;
c_const = 2.99792e14;

Lambda = 8:0.1:12;

length_Lambda = length(Lambda);
length_Radius = length(Radius);
length_Period = length(Period);
length_RefrIndex = length(RefrIndex);

lambda = zeros(1,1,length_Lambda);
for j = 1:length_Lambda
    lambda(1,1,j) = Lambda(j);
end;

period = zeros(1,1,length_Period);
for p = 1:length_Period
    period(1,1,p) = Period(p);
end;

refrindex = zeros(1,1, length_RefrIndex);
for n = 1:length_RefrIndex
    refrindex(1,1,n) = RefrIndex(n);
end;

radius = zeros(1,1,length_Radius);
for r = 1:length_Radius
    radius(1,1,r) = Radius(r);
end;

freq = zeros(1,1,length_Lambda);
k0 = zeros(1,1,length_Lambda);
x = zeros(1,1,length_Lambda);
rd = zeros(1,1,length_Period,length_Radius);
conc = zeros(1,1,length_Period,length_Radius);

fi1_x = zeros(1,1,length_Lambda);
d_fi1_x = zeros(1,1,length_Lambda,length_Radius);
fi1_mx = zeros(1,length_Lambda,length_RefrIndex);
d_fi1_mx = zeros(1,length_Lambda,length_RefrIndex,length_Radius);
zeta1_x = zeros(1,1,length_Lambda);
d_zeta1_x = zeros(1,1,length_Lambda);

a1 = zeros(1,length_Lambda,length_RefrIndex,length_Radius);
b1 = zeros(1,length_Lambda,length_RefrIndex,length_Radius);

alpha_e = zeros(1,length_Lambda,length_RefrIndex,length_Radius);
alpha_m = zeros(1,length_Lambda,length_RefrIndex,length_Radius);
hi_es = zeros(length_Period,length_Lambda,length_RefrIndex,length_Radius);
hi_ms = zeros(length_Period,length_Lambda,length_RefrIndex,length_Radius);

A = zeros(length_Period,length_Lambda,length_RefrIndex,length_Radius);
B = zeros(length_Period,length_Lambda,length_RefrIndex,length_Radius);

reflect = zeros(length_Period,length_Lambda,length_RefrIndex,length_Radius);
transm = zeros(length_Period,length_Lambda,length_RefrIndex,length_Radius);
denominator_r = zeros(length_Period,length_Lambda,length_RefrIndex,length_Radius);
denominator_t = zeros(length_Period,length_Lambda,length_RefrIndex,length_Radius);

for r = 1:length_Radius
    for n = 1:length_RefrIndex
        for p = 1:length_Period
            for j = 1:length_Lambda
                
                freq(j) = c_const/lambda(j);
                k0(j) = freq(j).*(2*pi)/c_const;
                x(j,r) = k0(j).*radius(r);
                rd(p,r) = 0.6956.*period(p);
                conc(p,r) = 1./((period(p))^2);
                
                fi1_x(j,r) = sin(x(j,r))/x(j,r)-cos(x(j,r));
                d_fi1_x(j,r) = (x(j,r)*cos(x(j,r))-sin(x(j,r)))/(x(j,r)^2)+sin(x(j,r));
                fi1_mx(1,j,n,r) = sin(refrindex(n)*x(j,r))/(refrindex(n)*x(j,r))-cos(refrindex(n)*x(j,r));
                d_fi1_mx(1,j,n,r) = ((refrindex(n)*x(j,r))*cos(refrindex(n)*x(j,r))-sin(refrindex(n)*x(j,r)))/((refrindex(n)*x(j,r))^2)+sin(refrindex(n)*x(j,r));
                zeta1_x(j,r) = -((1i+x(j,r))/x(j,r))*(cos(x(j,r))+1i*sin(x(j,r)));
                d_zeta1_x(j,r) = (1-(1-1i*x(j,r))/(x(j,r)^2))*(sin(x(j,r))-1i*cos(x(j,r)));
                
                a1(1,j,n,r) = (refrindex(n)*fi1_mx(1,j,n)*d_fi1_x(j,r)-fi1_x(j,r)*d_fi1_mx(1,j,n))/(refrindex(n)*fi1_mx(1,j,n)*d_zeta1_x(j,r)-zeta1_x(j,r)*d_fi1_mx(1,j,n));
                b1(1,j,n,r) = (fi1_mx(1,j,n)*d_fi1_x(j,r)-refrindex(1,1,n)*fi1_x(j,r)*d_fi1_mx(1,j,n))/(fi1_mx(1,j,n)*d_zeta1_x(j,r)-refrindex(1,1,n)*zeta1_x(j,r)*d_fi1_mx(1,j,n));
                
                alpha_e(1,j,n,r) = 6*pi*1i*a1(1,j,n,r)./((k0(j))^3);
                alpha_m(1,j,n,r) = 6*pi*1i*b1(1,j,n,r)./((k0(j))^3);
                hi_es(p,j,n,r) = conc(p,r).*alpha_e(1,j,n,r)./(1-conc(p,r).*alpha_e(1,j,n,r)./(4.*rd(p,r))); % concentration
                hi_ms(p,j,n,r) = conc(p,r).*alpha_m(1,j,n,r)./(1-conc(p,r).*alpha_m(1,j,n,r)./(4.*rd(p,r))); % concentration
                
                A(p,j,n,r) = (k0(j)/2).*hi_es(p,j,n,r);
                B(p,j,n,r) = -(k0(j)/2).*hi_ms(p,j,n,r);
                
                denominator_r(p,j,n,r) = (1-1i*A(p,j,n,r))*(1-1i*sqrt(epsilon)*B(p,j,n,r))+(1-1i*B(p,j,n,r))*(sqrt(epsilon)-1i*A(p,j,n,r));
                reflect(p,j,n,r) = ((1+1i*A(p,j,n,r))*(1-1i*sqrt(epsilon)*B(p,j,n,r))-(1+1i*B(p,j,n,r))*(sqrt(epsilon)-1i*A(p,j,n,r)))./denominator_r(p,j,n,r);
                denominator_t(p,j,n,r) = (sqrt(epsilon)-1i*A(p,j,n,r))*(1-1i*B(p,j,n,r))+(1-1i*sqrt(epsilon)*B(p,j,n,r))*(1-1i*A(p,j,n,r));
                transm(p,j,n,r) = ((1+1i*A(p,j,n,r))*(1+1i*B(p,j,n,r))+(1+1i*B(p,j,n,r))*(1-1i*A(p,j,n,r)))./denominator_t(p,j,n,r);
            end;
        end;
    end;
end;

Transmittance = (abs(transm)).^2;
Reflectance = (abs(reflect)).^2;
Absorptance = 1-sqrt(epsilon)*Transmittance-Reflectance;

figure;
plot(Lambda, alpha_m);
saveas(gcf,imagePath);

% for i=1:2
%     plot(Lambda,Reflectance(:,:,i,:)*100);
%     hold on;
% end;
% plot(Lambda, Reflectance);

toc

clear all;

quit force

